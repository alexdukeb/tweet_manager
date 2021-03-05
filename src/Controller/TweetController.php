<?php

 namespace App\Controller;


 use App\Entity\Tweet;
 use App\Repository\TweetRepository;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;

 /**
  * Class TweetController
  * @package App\Controller
  * @Route("/api", name="tweet_api")
  */
 class TweetController extends AbstractController
 {
    /**
     * @param TweetRepository $tweetRepository
     * @return JsonResponse
     * @Route("/tweets", name="tweets", methods={"GET"})
     */
    public function getTweets(TweetRepository $tweetRepository){
    $data = $tweetRepository->findAll();
    return $this->response($data);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TweetRepository $tweetRepository
     * @return JsonResponse
     * @throws \Exception
     * @Route("/tweets", name="tweets_add", methods={"POST"})
     */
    public function addTweet(Request $request, EntityManagerInterface $entityManager, TweetRepository $tweetRepository){

    try{
        $request = $this->transformJsonBody($request);

        if (!$request || !$request->get('message') || !$request->request->get('author')){
        throw new \Exception();
        }

        $tweet = new Tweet();
        $tweet->setMessage($request->get('message'));
        $tweet->setAuthor($request->get('author'));
        $entityManager->persist($tweet);
        $entityManager->flush();

        $data = $tweet->getId();
        return $this->response($data);

    }catch (\Exception $e){
        $data = [
        'status' => 422,
        'errors' => "Data no valid",
        ];
        return $this->response($data, 422);
    }

    }


    /**
     * @param TweetRepository $tweetRepository
     * @param $id
     * @return JsonResponse
     * @Route("/tweets/{id}", name="tweets_get", methods={"GET"})
     */
    public function getTweet(TweetRepository $tweetRepository, $id){
    $tweet = $tweetRepository->find($id);

    if (!$tweet){
        $data = [
        'status' => 404,
        'errors' => "Tweet not found",
        ];
        return $this->response($data, 404);
    }
    return $this->response($tweet);
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