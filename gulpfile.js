"use strict";

var gulp = require('gulp');
var sass = require('gulp-sass');// подключаем gulp-sass
var minifyCss = require('gulp-clean-css');//минификация css
var rename = require('gulp-rename');
var notify = require("gulp-notify");
var autoprefixer = require('gulp-autoprefixer');
var clean = require("gulp-clean");
var combineMq = require('gulp-combine-mq');
var spritesmith = require('gulp.spritesmith');​

gulp.task('hello', function() {
    console.log('hello world!');
});​