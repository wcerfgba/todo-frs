var gulp = require('gulp');

gulp.task('default', [ 'bower' ]);

gulp.task('bower', function () {
  gulp.src('bower_components/**')
    .pipe(gulp.dest('web/assets/vendor/'));
});
