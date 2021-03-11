<?php

 namespace App\Controller;


 use App\Entity\Tweet;
 use App\Repository\TweetRepository;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;

 use App\Service\TweetManager;


 /**
  * Class TweetController
  * @package App\Controller
  * @Route("/api", name="tweet_api")
  */
 class TweetController extends AbstractController
 {


    public function __construct(TweetManager $tweetmanager, EntityManagerInterface $em)
    {
        $this->tweetmanager = $tweetmanager;
        $this->em = $em;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/tweets", name="tweets", methods={"GET"})
     */
    public function getTweets(Request $request){
        $data = $this->tweetmanager->getAllByParams(
            $request->query->get('page') ? $request->query->get('page') : 1, 
            $request->query->get('count') ? $request->query->get('count') : 25, 
            $request->query->get('author') ? $request->query->get('author') : false, 
            $request->query->get('hashtag') ? $request->query->get('hashtag') : false
        );
        return $this->response($data);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * @throws \Exception
     * @Route("/tweets", name="tweets_add", methods={"POST"})
     */
    public function addTweet(Request $request){

    try{
        $request = $this->transformJsonBody($request);
        if (!$request || !$request->request->get('message') || !$request->request->get('author')){
        throw new \Exception();
        }
        if ($request->request->get('hashtags')) {
            $data = $this->tweetmanager->createTweet($request->request->get('author'), $request->request->get('message'), $request->request->get('hashtags'));
        } else {
            $data = $this->tweetmanager->createTweet($request->request->get('author'), $request->request->get('message'));
        }

        return $this->response($data);

    } catch (\Exception $e){
        $data = [
        'status' => 422,
        'errors' => "Wrong request body, missing params.",
        ];
        return $this->response($data, 422);
    }

    }

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
    return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
    {
    $data = json_decode($request->getContent(), true);

    if ($data === null) {
        return $request;
    }

    $request->request->replace($data);

    return $request;
    }

 }