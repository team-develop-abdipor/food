<?php

class Chart {
    var $data;  // The data array to display
    var $type; // Vertical:1 or Horizontal:0 chart
    var $title; // The title of the chart
    var $width;  // The chart box width
    var $height; // The chart box height
    var $meta_space_horizontal = 60; // Total space needed for chart title + bar title + bar value
    var $meta_space_vertical = 60; // Total space needed for chart title + bar title + bar value
    var $various_colors;//true or false

    function Chart($data) {
        $this->data = $data;
    }

    function displayChart($title = '', $type, $width = 300, $height = 200, $various_colors = true, $user_color) {
        $this->type = $type;
        $this->title = $title;
        $this->width = $width;
        $this->height = $height;
        $this->various_colors = $various_colors;
        echo '<div class="chartbox" style="width:' . $this->width . 'px; height:' . $this->height . 'px;"><h2>' . $this->title . '</h2>' . "\r\n";
        if($this->type == 1)
            $this->drawVertical($user_color);
        else $this->drawHorizontal($user_color);
        echo '</div>';
    }

    function getMaxDataValue() {
        $max = 0;
        foreach($this->data as $key => $value) {
            if($value > $max)
                $max = $value;
        }
        return $max;
    }

    function getElementNumber() {
        return sizeof($this->data);
    }

    function drawVertical($user_color) {
        $multi = ($this->height - $this->meta_space_horizontal) / $this->getMaxDataValue();
        $max = $multi * $this->getMaxDataValue();
        $barw = 50;//floor($this->width / $this->getElementNumber()) - 4;
        $i = 1;
        foreach($this->data as $key => $value) {
            $b = floor($max - ($value * $multi));
            $a = $max - $b;
            if($this->various_colors)
                $color = ($i % 5) + 1;
            else $color = $user_color;
            $i++;
            echo '<div class="barv">' . "\r\n";
            echo '<div class="barvvalue" style="margin-top:' . $b . 'px; width:' . $barw . 'px;">' . $value . '</div>' . "\r\n";
            echo '<div><img src="include/diagram/chart/images/bar' . $color . '.png" width="' . $barw . '" height="' . $a . '" alt="' . $color . '">
</div>' . "\r\n";
            echo '<div class="barvvalue" style="width:' . $barw . 'px; ">' . $key . '</div>' . "\r\n";
            echo '</div>' . "\r\n";
        }
    }

    function drawHorizontal($user_color) {
        $multi = ($this->width - 170) / $this->getMaxDataValue();
        $max = $multi * $this->getMaxDataValue();
        $barh = floor(($this->height - 50) / $this->getElementNumber());
        $i = 1;
        foreach($this->data as $key => $value) {
            $b = floor($value * $multi);
            if($this->various_colors)
                $color = ($i % 5) + 1;
            else $color = $user_color;
            $i++;

            if($value>0)
            {
                $value .=" تومان ";
            }
            else
            {
                $value .="|";
            }

            echo '<div class="barh" style="height:' . $barh . 'px;">' . "\r\n";
            echo '<div class="barhcaption" style="line-height:' . $barh . 'px; width:100px;"><strong>' . $key . '</strong></div>' . "\r\n";
            echo '<div class="barhimage"><img src="include/diagram/chart/images/barh' . $color . '.png" alt="' . $color . '" style="width:' . $b . 'px; height:' . $barh . 'px;"></div>' . "\r\n";
            echo '<div class="barhvalue" style="line-height:' . $barh . 'px;"><strong>' . $value. '</strong></div>' . "\r\n";
            echo '</div>';
        }
    }
}