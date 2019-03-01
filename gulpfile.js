"use strict";
let gulp = require('gulp');
let less = require('gulp-less');
let path = require('path');
let cleanCSS = require('gulp-clean-css');
let decomment = require('gulp-decomment');
let gulpSequence = require('gulp-sequence');


gulp.task('less', function () {
  return gulp.src('./css/makeup.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('./css/dist'));
});


gulp.task('mini', function(){ 
  return gulp.src('./css/dist/makeup.css')
    .pipe(cleanCSS( {compatibility: 'ie8'}))
    .pipe(gulp.dest('./css/dist/min/'));
});
 
gulp.task('comments', function () {
  return gulp.src('./css/dist/min/makeup.css')
    .pipe(decomment.text())
    .pipe(gulp.dest('./css/dist/'));
});

gulp.task('make', gulpSequence('less', 'mini', 'comments'));
