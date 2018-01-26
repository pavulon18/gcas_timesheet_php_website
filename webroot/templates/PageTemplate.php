<?php
/*
 * The MIT License
 *
 * Copyright 2018 Jim Baize <pavulon@hotmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of PageTemplate
 * 
 * January 23, 2018
 * This is going to be the basis of all the pages on this site.  I have some preliminary
 * drawings of how I want the site to look.  I can implement those later.
 *
 * @author Jim Baize <pavulon@hotmail.com>
 */
class PageTemplate
{

    //PageTemplate's attributes
    public $content;
    public $title = "Gibson County Ambuance Service Web Portal";

    //Operations
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function Display()
    {
        echo "<html>\n<head>\n";
        $this->DisplayTitle();
        $this->DisplayKeywords();
        $this->DisplayStyles();
        echo "</head>\n<body>\n";
        $this->DisplayHeader();
        //$this->DisplayMenu($this->buttons);
        echo $this->content;
        $this->DisplayFooter();
        echo "</body>\n</html>\n";
    }

    public function DisplayTitle()
    {
        echo "<title>" . $this->title . "</title>";
    }

    public function DisplayKeywords()
    {
        //echo "<meta name='keywords' content='" . $this->keywords . "'/>";
    }

    public function DisplayStyles()
    {
        ?>   
        <link href="styles.css" type="text/css" rel="stylesheet">
        <?php
    }

    public function DisplayHeader()
    {
        ?>   
        <!-- page header -->
        <header>    
        <!--    <img src="logo.gif" alt="TLA logo" height="70" width="70" />  -->
            <h1>Gibson County Ambulance Service</h1>
        </header>
        <?php
    }

    public function DisplayMenu($buttons)
    {
        echo "<!-- menu -->
    <nav>";

        while (list($name, $url) = each($buttons))
        {
            $this->DisplayButton($name, $url, !$this->IsURLCurrentPage($url));
        }
        echo "</nav>\n";
    }

    public function IsURLCurrentPage($url)
    {
        if (strpos($_SERVER['PHP_SELF'], $url) === false)
        {
            return false;
        } else
        {
            return true;
        }
    }

    public function DisplayButton($name, $url, $active = true)
    {
        if ($active)
        {
            ?>
            <div class="menuitem">
                <a href="<?= $url ?>">
                    <img src="s-logo.gif" alt="" height="20" width="20" />
                    <span class="menutext"><?= $name ?></span>
                </a>
            </div>
        <?php
        } else
        {
            ?>
            <div class="menuitem">
                <img src="side-logo.gif">
                <span class="menutext"><?= $name ?></span>
            </div>
            <?php
        }
    }

    public function DisplayFooter()
    {
        ?>
        <!-- page footer -->
        <footer>

        </footer>
        <?php
    }

}
?>

