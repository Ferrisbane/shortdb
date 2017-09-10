```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {

        $basicIcons = '<h2>Basic Icons</h2> {fa|icon:camera-retro} fa-camera-retro';
        $largerIcons = '<h2>Larger Icons</h2>
        {fa|icon:camera-retro|size:lg} fa-lg
        {fa|icon:camera-retro|size:2x} fa-2x
        {fa|icon:camera-retro|size:3x} fa-3x
        {fa|icon:camera-retro|size:4x} fa-4x
        {fa|icon:camera-retro|size:5x} fa-5x';

        $fixedWidthIcons = '<h2>Fixed Width Icons</h2>
        <div class="list-group">
            <a class="list-group-item" href="#">{fa|icon:home|fixed-width}&nbsp; Home</a>
            <a class="list-group-item" href="#">{fa|icon:book|fixed-width}&nbsp; Library</a>
            <a class="list-group-item" href="#">{fa|icon:pencil|fixed-width}&nbsp; Applications</a>
            <a class="list-group-item" href="#">{fa|icon:cog|fixed-width}&nbsp; Settings</a>
        </div>';

        $listIcons = '<h2>List Icons</h2>
        <ul class="fa-ul">
            <li>{fa|icon:check-square|list}List icons</li>
            <li>{fa|icon:check-square|list}can be used</li>
            <li>{fa|icon:spinner|list|spin}as bullets</li>
            <li>{fa|icon:square|list}in lists</li>
        </ul>';

        $borderedIcons = '<h2>Bordered &amp; Pulled Icons</h2>
        {fa|icon:quote-left|size:3x|pull:left|border}
        ...tomorrow we will run faster, stretch out our arms farther...
        And then one fine morning&mdash; So we beat on, boats against the
        current, borne back ceaselessly into the past.';

        $animatedIcons = '<br><br><br><h2>Animated Icons</h2>
        {fa|icon:spinner|size:3x|fixed-width|spin}
        {fa|icon:circle-o-notch|size:3x|fixed-width|spin}
        {fa|icon:refresh|size:3x|fixed-width|spin}
        {fa|icon:cog|size:3x|fixed-width|spin}
        {fa|icon:spinner|size:3x|fixed-width|pulse}';

        $rotatedIcons = '<h2>Rotated &amp; Flipped</h2>
        {fa|icon:shield} normal<br>
        {fa|icon:shield|rotate:90} fa-rotate-90<br>
        {fa|icon:shield|rotate:180} fa-rotate-180<br>
        {fa|icon:shield|rotate:270} fa-rotate-270<br>
        {fa|icon:shield|flip:horizontal} fa-flip-horizontal<br>
        {fa|icon:shield|flip:vertical} fa-flip-vertical<br>';

        $content = shortdb($basicIcons.$largerIcons.$fixedWidthIcons.$listIcons.$borderedIcons.$animatedIcons.$rotatedIcons);
	}

}
```