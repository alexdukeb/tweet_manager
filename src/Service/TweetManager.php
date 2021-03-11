<?php 

// src/Service/TweetManager.php
namespace App\Service;
use Symfony\Flex\Response;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


use App\Entity\Tweet;
use App\Entity\Hashtag;
use App\Repository\TweetRepository;




class TweetManager
{
    private $em;
    private $tweetrepository;


    public function __construct(EntityManagerInterface $em, TweetRepository $tweetrepository)
    {
        $this->em = $em;
        $this->tweetrepository = $tweetrepository;
    }

    public function createTweet($author, $message, $hashtags = [])
    {
        $tweet = new Tweet();
        $tweet->setMessage($message);
        $tweet->setAuthor($author);
        if(count($hashtags) > 0) {
            foreach($hashtags as $hashtag) {
                $hashtagObject = new Hashtag();
                $hashtagObject->setContent($hashtag);
                $tweet->setHashtag($hashtagObject);
            }
        }
        $this->em->persist($tweet);
        $this->em->flush();

        return $tweet->getId();
    }

    public function getAll()
    {
        $tweets = $this->tweetrepository->findAll();
        return $tweets;
    }
}