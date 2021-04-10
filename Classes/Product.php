<?php


class Product
{
    private int $id;
    private string $title;
    private float $price;
    private string $img;
    

    /**
     * Product constructor.
     *
     * @param int    $id
     * @param string $title
     * @param float  $price
     * @param int    $availableQuantity
     */
    public function __construct($id, $title, $price, $img)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->img = $img;
        
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

  

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

  

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function getImg()
    {
        return $this->img;
    }



  
    
}