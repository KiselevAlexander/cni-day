const gulp = require('gulp');
const connect = require('gulp-connect-php');
const browserSync = require('browser-sync');


const phpSettings = { 
    base: 'src', 
    port: 8010, 
    keepalive: true
};

gulp.task('connect', function() {
    connect.server(phpSettings);
});
 

gulp.task('connect-sync', function() {
  connect.server(phpSettings, function (){
    browserSync({
      proxy: '127.0.0.1:8010'
    });
  });
 
  gulp.watch('src/**/*.php').on('change', function () {
    browserSync.reload();
  });
});



gulp.task('default', ['connect-sync']);