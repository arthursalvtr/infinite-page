<?php
declare(strict_types=1);
/**
 * User: ERIC
 * Date: 2/24/2020
 * Time: 9:19 AM
 */

namespace App\Support;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\ItemInterface;

class Generator
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Logger
     */
    private $log;

    /**
     * Generator constructor.
     *
     * @param Request  $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->log = new Logger('local');
        $this->log->pushHandler(new StreamHandler(print_path([
            __ROOT__, 'debug.log',
        ]), Logger::DEBUG));

    }

    public function generate()
    {
        if ($this->request->getPathInfo() !== "/") {
            return $this->detailPage();
        }

        $articles = [];
        $hotArticles = [];
        foreach ($this->getArticles(5) as $article) {
            $articles[] = $article;
        }
        foreach ($this->getArticles(5) as $article) {
            $hotArticles[] = $article['title'];
        }

        $this->response->setContent(view('index', [
            'articles' => $articles,
            'hotArticles' => $hotArticles,
        ]));
        return $this->response->send();
    }

    /**
     * @param int $size
     *
     * @return \Generator
     */
    private function getArticles(int $size): \Generator
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < $size; $i++) {
            yield [
                'title' => $faker->realText(60),
                'author' => $faker->name(),
                'text' => $faker->realText(500),
                'image' => $faker->imageUrl(300, 200),
            ];
        }
    }

    private function detailPage()
    {
        $cache = new FilesystemAdapter(
            '', 0, print_path([ __ROOT__, 'public', 'cache' ])
        );
        $key = md5($this->request->getPathInfo());
        $value =  $cache->get($key, function (ItemInterface $item) use ($key) {
            $item->expiresAfter(3600);
            $article = $this->getArticles(1)->current();
            $hotArticles = [];
            foreach ($this->getArticles(5) as $article) {
                $hotArticles[] = $article['title'];
            }

            $data = [
                'hotArticles' => $hotArticles,
            ];
            return view('detail', array_merge($article, $data));
        });
        $this->response->setContent($value);
        return $this->response->send();

    }
}
