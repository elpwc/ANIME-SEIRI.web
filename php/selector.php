<?php
class SelectorItem
{
    public function __construct($title, $get_name, $active = false, $id = "")
    {
        $this->title = $title;
        $this->get_name = $get_name;
        $this->active = $active;
        $this->id = $id;
        if ($id == "") {
            $this->id = $get_name;
        }
    }
  
    public $title = "";
    public $get_name = "";
    public $active = false;
    public $id="";

    public function HTML($script="")
    {
        $active_text = "";
        $script_text = "";
        if ($this->active) {
            $active_text = " active";
        }
        if ($script != "") {
            $script_text="
      <script type=\"text/javascript\">
      ".$script."
      </script>
      ";
        }
        echo("
    <li class=\"nav-item\" id='li_".$this->id."'>
    <a class=\"nav-link".$active_text."\" id='".$this->id."' data-get-name='".$this->get_name."' href=\"#\">".$this->title."</a>
    </li>
    ".$script_text."
    ");
    }
}

class Selector
{
    public function __construct($id, $title, $items=[], $get_name, $selected = -1)
    {
        $this->id = $id;
        $this->title = $title;
        $this->get_name = $get_name;
        $this->items = $items;
        $this->selected = $selected;
        $i = 0;
        foreach ($items as $item) {
            if ($item->active == true) {
                $this->selected = $i;
                break;
            }
            $i ++;
        }
        if ($i == sizeof($items)) {
            $this->selected = -1;
        }
    }
    public $items=[];
    public $title="";
    public $id="";
    public $selected = -1;

    public $get_name ="";


    public function HTML()//type 1: year
    {
        if ($this->selected >= 0 && $this->selected < sizeof($this->items)) {
            $this->items[$this->selected]->active = true;
        }
        echo("
                <div id=\"".$this->id."\" class=\"selector\" data-get-name=\"".$this->get_name."\">
                <h6><span class=\"\">".$this->title."</span></h6>
                    <ul class=\"nav nav-pills\">
                ");
        if ($this->selected == -1) {
            $this->print_Allbtn_HTML(true);
        } else {
            $this->print_Allbtn_HTML(false);
        }
            
        $i = 0;
        $box = [];
        foreach ($this->items as $item) {
            //from allanimes.js

            $i++;

            if ($i>7) {
                array_push($box, $item);
            } else {
                $script = "
                  $(function(){
                    var crtitem = $('#".$this->id." #".$item->id."')
                    crtitem.click(function(){
                      item_click('".$this->id."',crtitem)
                    });
                  });

                  ";
                $item->HTML($script);
            }
        }
        
        //item过多而显示的下拉小盒子~
        if (sizeof($box)!=0) {
          echo('    <div class="btn-group">
          <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" data-display="static"
            aria-expanded="false">
          </button>
          <div class="dropdown-menu p-4 text-muted" style="width: 500px;">
          <ul class="nav nav-pills">');
          foreach ($box as $box_item) {
            $script = "
            $(function(){
              var crtitem = $('#".$this->id." #".$box_item->id."')
              crtitem.click(function(){
                item_click('".$this->id."',crtitem)
              });
            });

            ";
          $box_item->HTML($script);
          }
          echo('</ul>
          </div>
        </div>');
        }



        echo("</ul></div>");
    }
    
    //从数组建立items
    public static function make_items($item_title, $item_get_name, $item_active=[], $item_id = [], $selected_get_name = "")
    {
        $res = [];
        for ($i = 0; $i < sizeof($item_title); $i++) {
            if ($item_active == []) {
                if ($selected_get_name == "" || $selected_get_name == "all") {
                    if ($item_id == []) {
                        array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], false, ""));
                    } else {
                        array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], false, $item_id[$i]));
                    }
                } else {
                    //有被选中项
                    if ($item_get_name[$i] == $selected_get_name) {
                        if ($item_id == []) {
                            array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], true, ""));
                        } else {
                            array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], true, $item_id[$i]));
                        }
                    } else {
                        if ($item_id == []) {
                            array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], false, ""));
                        } else {
                            array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], false, $item_id[$i]));
                        }
                    }
                }
            } else {
                if ($item_id == []) {
                    array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], false, ""));
                } else {
                    array_push($res, new SelectorItem($item_title[$i], $item_get_name[$i], false, $item_id[$i]));
                }
            }
        }
        return $res;
    }
    //echo“全部”item
    private function print_Allbtn_HTML($select = true)
    {
        $script = "
    $(function(){
      $('#".$this->id." #all').click(function(){
        allbtn_item_click('".$this->id."')
      });
    });

    ";
        (new SelectorItem("全部", "", $select, "all"))->HTML($script);
    }

    public function selected()
    {
        $i = 0;
        foreach ($this->items as $item) {
            if ($item->active == true) {
                return $i;
            }
            $i++;
        }
        return -1;
    }
}
