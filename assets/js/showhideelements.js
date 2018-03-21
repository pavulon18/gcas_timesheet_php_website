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


$(document).ready(function() {
 // hides the slickbox as soon as the DOM is ready (a little sooner that page load)
  $('#slickbox').hide();
  
 // shows and hides and toggles the slickbox on click  
  $('#slick-show').click(function() {
    $('#slickbox').show('slow');
    return false;
  });
  $('#slick-hide').click(function() {
    $('#slickbox').hide('fast');
    return false;
  });
  $('#slick-toggle').click(function() {
    $('#slickbox').toggle(400);
    return false;
  });

 // slides down, up, and toggle the slickbox on click    
  $('#slick-down').click(function() {
    $('#slickbox').slideDown('slow');
    return false;
  });
  $('#slick-up').click(function() {
    $('#slickbox').slideUp('fast');
    return false;
  });
  $('#slick-slidetoggle').click(function() {
    $('#slickbox').slideToggle(400);
    return false;
  });
});