<?php
    include "header.php";
?>
<body background="http://remtsoy.com/tf_templates/traveler/demo_v1_7/img/196_365_2048x1365.jpg">

<div class="container search-tabs search-tabs-bg">
  <h2>Dynamic Tabs</h2>
  <p>To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a div element with class .tab-content.</p>
  <div class="tabbable">
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-plane"></i><span>Home</span></a></li>
    <li><a data-toggle="tab" href="#menu1"><i class="fa fa-plane"></i><span>Home</span></a></li>
    <li><a data-toggle="tab" href="#menu2"><i class="fa fa-plane"></i><span>Home</span></a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h2>Search for Cheap Flights</h2>
        <form>
            <div class="tabbable">
                <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                    <li class="active" id="cob"><a href="#flight-search-1" data-toggle="tab">Round Trip</a></li>
                    <li><a href="#flight-search-2" data-toggle="tab">One Way</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="flight-search-1">
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-lg form-group-icon-left">
                                    <i class="fas fa-map-marker-alt input-icon"></i>
                                    <label>From</label>
                                    <span class="twitter-typeahead" style="position: relative; display: block; direction: ltr;">
                                    <input class="typeahead form-control tt-hint" type="text" disabled="" autocomplete="off" spellcheck="false" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(255, 255, 255, 0.5);">
                                    <input class="typeahead form-control tt-input" placeholder="City, Airport, U.S. Zip" type="text" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Open Sans&quot;, Tahoma, Arial, helvetica, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;"><div class="tt-dataset-1"></div></span></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-lg form-group-icon-left"><i class="fas fa-map-marker-alt input-icon"></i>
                                    <label>To</label>
                                    <span class="twitter-typeahead" style="position: relative; display: block; direction: ltr;"><input class="typeahead form-control tt-hint" type="text" disabled="" autocomplete="off" spellcheck="false" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(255, 255, 255, 0.5);"><input class="typeahead form-control tt-input" placeholder="City, Airport, U.S. Zip" type="text" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Open Sans&quot;, Tahoma, Arial, helvetica, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;"><div class="tt-dataset-2"></div></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-daterange" data-date-format="M d, D">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                                        <label>Departing</label>
                                        <input class="form-control" name="start" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                                        <label>Returning</label>
                                        <input class="form-control" name="end" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-lg form-group-select-plus" id="foobar">
                                        <label>Passngers</label>
                                        <div class="btn-group btn-group-select-num hidden" data-toggle="buttons">
                                            <label class="btn btn-primary active">
                                            <input type="radio" name="options" value="1" class="satu">1</label>
                                            <label class="btn btn-primary">
                                            <input type="radio" name="options" value="2">2</label>
                                            <label class="btn btn-primary">
                                            <input type="radio" name="options" value="3">3</label>
                                            <label class="btn btn-primary">
                                            <input type="radio" name="options" value="3+">3+</label>
                                        </div>
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option selected="selected">4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="flight-search-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-lg form-group-icon-left"><i class="fas fa-map-marker-alt input-icon"></i>
                                    <label>From</label>
                                    <span class="twitter-typeahead" style="position: relative; display: block; direction: ltr;"><input class="typeahead form-control tt-hint" type="text" disabled="" autocomplete="off" spellcheck="false" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(255, 255, 255, 0.5);"><input class="typeahead form-control tt-input" placeholder="City, Airport, U.S. Zip" type="text" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Open Sans&quot;, Tahoma, Arial, helvetica, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;"><div class="tt-dataset-3"></div></span></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-lg form-group-icon-left"><i class="fas fa-map-marker-alt input-icon"></i>
                                    <label>To</label>
                                    <span class="twitter-typeahead" style="position: relative; display: block; direction: ltr;"><input class="typeahead form-control tt-hint" type="text" disabled="" autocomplete="off" spellcheck="false" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(255, 255, 255, 0.5);"><input class="typeahead form-control tt-input" placeholder="City, Airport, U.S. Zip" type="text" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Open Sans&quot;, Tahoma, Arial, helvetica, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;"><div class="tt-dataset-4"></div></span></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3 kucing anjing">
                                <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                                    <label>Departing</label>
                                    <input class="date-pick form-control" data-date-format="M d, D" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-lg form-group-select-plus">
                                    <label>Passngers</label>
                                    <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="options">1</label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options">2</label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options">3</label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options">3+</label>
                                    </div>
                                    <select class="form-control hidden">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option selected="selected">4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg" type="submit">Search for Flights</button>
        </form>                
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>
</div>
</body>
</html>
