<?php
/**
  The MIT License

  Copyright 2018 Jim Baize <pavulon@hotmail.com>.

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.

 * ********************************

  The original license and copyright before Jim Baize's modifications:

  The MIT License (MIT)

  Copyright (c) 2013-2018 Blackrock Digital LLC

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.

  http://startbootstrap.com/template-overviews/thumbnail-gallery/
  https://github.com/BlackrockDigital/startbootstrap-thumbnail-gallery

  -->
 * 
 */
Miscellaneous::checkIsLoggedIn();

$dirToSend = './assets/gallery';

function find_all_files($dir)
{
    $root = scandir($dir);
    
    foreach ($root as $value)
    {

        if ($value === '.' || $value === '..')
        {
            continue;
        }
        if (is_file("$dir/$value"))
        {
            $result[] = "$dir/$value";
            continue;
        }
        foreach (find_all_files("$dir/$value") as $value)
        {
            $result[] = $value;
            
        }
        
        
    }
    return $result;
}

$dirResult = find_all_files($dirToSend);

?>
<!-- Page Content -->
<div class="container">

    <h1 class="my-4 text-center text-lg-left">Thumbnail Gallery</h1>

    <div class="row text-center text-lg-left">
        <?php
        foreach ($dirResult as $item) :
        ?>

        <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src=<?php echo $item; ?> alt="">
            </a>
        </div>
        
        <?php endforeach; ?>
        
    </div>

</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript -->
<!-- 
This functionality should already be included in main.php 

I'm going to leave these lines in here until I know for sure.
Jim 9-18-18

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
-->