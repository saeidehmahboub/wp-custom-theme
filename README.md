# Itineris WP Custom Theme

## Introduction

This is my technical challenge a custom WordPress theme for Itineris company. It has a page that included a list of courses.

## Installation and Configuration

First, you need to install [WordPress](https://wordpress.org/download/) then go to the `wp-content/theme` and clone the project here. After that, you need to active the theme on dashboard admin-panel: `Appearance -> theme` active the Itineris wp custom theme.

Now you can see the Courses on the left menu and it included 2 parts: Campus and Course Type. From there you can add new Campus and Course tyep then add new course.

## Technical Istallation

For technical part please run `comuser install` and `npm install` in command line.
Also, for webpack I used the Grunt so please [downlaod the Grunt CLI](https://gruntjs.com/getting-started) and then npm install. If you want to add new css or js you need to run `grunt watch` in command line.

## Change CSS

For the CSS style, I already used the SASS. If you want to add some styles you can go to `assets/scss` select file and add whatever you want.

`Note:` `grunt watch` should be run for compile the sass files

## Change JavaScript

In order to change JavaScript codes you need to edit `assets/js/script.js`.

`Note:` `grunt watch` should be run for minify JS files.

## PHP Classes

All logics related to functionalities have been located in `includes` directory. As you see there I managed theme options, text domian, register custom post, and taxonomies.

## Itineris Check Code

In order to check code you need to run `composer style:check` in command line.

`Note:` You need to ensure befor checking you run the `composer install`.
