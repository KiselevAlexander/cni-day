const gulp = require('gulp');
const connect = require('gulp-connect-php');
const browserSync = require('browser-sync');
const plumber     = require('gulp-plumber');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');

const PATHS = {
    SOURCE: {
        SCSS: 'src/scss/'
    },
    OUTPUT: {
        CSS: 'docs/static/css/'
    }
};

const phpSettings = { 
    base: 'docs',
    port: 8010, 
    keepalive: true
};

gulp.task('connect', function() {
    connect.server(phpSettings);
});

gulp.task('sass', () =>
    gulp
        .src(`${PATHS.SOURCE.SCSS}**/**.scss`)
        .pipe(sass({
            outputStyle: 'compressed'  // expanded
        })
            .on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: [
                'Chrome >= 8',
                'Firefox >= 3.5',
                'ie >= 8',
                'Safari >= 4',
                'Opera >= 12',
                'Android 2.3',
                'Android >= 4',
                'iOS >= 6'
            ],
            cascade: false
        }))
        .pipe(gulp.dest(PATHS.OUTPUT.CSS))
        .pipe(browserSync.stream())
    );
 

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


gulp.task('default', ['sass', 'connect-sync'], () => {
    gulp.watch(`${PATHS.SOURCE.SCSS}**/*.scss`, ['sass']);
    // gulp.watch(PATHS.SOURCE.IMAGES, ['images']);
    // gulp.watch(PATHS.SOURCE.FONTS, ['fonts']);
});

gulp.task('build', ['sass']);