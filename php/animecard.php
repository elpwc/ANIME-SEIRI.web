<?php
class AnimeBoard{
  public $animes = [];
  public $num_per_page = 50;


}




class Anime{
  //basic attr
  public $name = "";
  public $ori_name = "";
  public $bgm_rank = 0;
  public $country = 'ja';
  public $type = 0;
  public $housou_stat = 0;
  public $housou_date = 0;
  public $id = 0;
  public $episode = 0;
  public $epi_len_type = 0;
  public $official_page = "#";
  public $image_url = "#";
  public $bangumi_id = 0;
  public $housou_links = ["#"];

  //user attr
  public $watch_stat = 0;

  public function __construct($id, $name)
  {
    $this->id = $id;
    $this->name = $name;
  }

  public function HTML(){
    
  }

  
}