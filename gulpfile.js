const gulp = require('gulp');
const connect = require('gulp-connect-php');
const browserSync = require('browser-sync');
const plumber     = require('gulp-plumber');


const phpSettings = { 
    base: 'docs',
    port: 8010, 
    keepalive: true
};

gulp.task('connect', function() {
    connect.server(phpSettings);
});
 

gulp.task('connect-sync', function() {

    connect.server(phpSettings, function (){

        browserSync({
            proxy: '127.0.0.1:8010',
            reqHeaders: function (config) {
                console.log(config);
                return {
                    "accept-encoding": "UTF-8",
                    "content-type": "UTF-8"
                }
            },
            middleware: function (req, res, next) {
                res.setHeader("Content-type", 'UTF-8');
                next();
            }
        });
    });
 
    gulp.watch(['docs/*.php', 'docs/local/**/*.*'],  function () {
        browserSync.reload();
    });

});



gulp.task('default', ['connect-sync']);