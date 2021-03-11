<?php
 namespace App\Entity;
 use App\Entity\Hashtag;
 use Doctrine\ORM\Mapping as ORM;
 use Doctrine\Common\Collections\ArrayCollection;
 use Symfony\Component\Validator\Constraints as Assert;
 /**
  * @ORM\Entity
  * @ORM\Table(name="tweets")
  * @ORM\HasLifecycleCallbacks()
  */
 class Tweet implements \JsonSerializable {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     *
     */
    private $message;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hashtag", mappedBy="tweet", cascade={"persist"})
     */
    private $hashtags;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_date;

    public function __construct()
    {
        $this->hashtags = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
    return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
    $this->id = $id;
    }
   /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getHashtags()
    {
        $htags = $this->hashtags;
        $data = [];
        foreach ($htags as $h) {
            $data[] = $h->getContent();
        }
        return $data;
    }
    /**
     * @param mixed $author
     */
    public function setHashtag(Hashtag $hashtag)
    {
        $this->hashtags[] = $hashtag;
        $hashtag->setTweet($this);
    }

    /**
     * @return mixed
     */
    public function getCreateDate(): ?\DateTime
    {
    return $this->create_date;
    }

    /**
     * @param \DateTime $create_date
     * @return Tweet
     */
    public function setCreateDate(\DateTime $create_date): self
    {
    $this->create_date = $create_date;
    return $this;
    }

    /**
     * @throws \Exception
     * @ORM\PrePersist()
     */
    public function beforeSave(){
        $this->create_date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
    }



    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $json = [
            "message" => $this->getMessage(),
            "author" => $this->getAuthor(),
        ];
        if(count($this->getHashtags())) {
            $json["hastags"] = $this->getHashtags();
        }
        return $json;
    }
 }