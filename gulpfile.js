var gulp = require('gulp');
var webpack = require('webpack-stream');

gulp.task('default', [ 'bower', 'react' ]);

gulp.task('bower', function () {
  gulp.src('bower_components/**')
    .pipe(gulp.dest('web/assets/vendor/'));
});

gulp.task('react', function () {
  gulp.src('react/index.js')
    .pipe(webpack( require('./webpack.config.js') ))
    .pipe(gulp.dest('web/assets/'));
});
