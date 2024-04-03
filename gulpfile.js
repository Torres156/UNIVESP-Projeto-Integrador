import gulp from 'gulp';
import minify from 'gulp-minify';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);

const paths = {
    src: {
        'scss': 'resources/scss/*.scss',
        'js': 'resources/js/*.js',
        // 'img': ['resources/assets/img/**/*' , '!resources/assets/img/svg/**']
    },
    dist: {
        'css': 'public/assets/css/',
        'js': 'public/assets/js/',
        // 'img': 'public/img/',
    }
}

gulp.task('sass', function() {
    return gulp.src(paths.src.scss)
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(gulp.dest(paths.dist.css));
});

gulp.task('js', async function() {
    return gulp.src(paths.src.js)
        .pipe(minify({
            noSource: true,
            ext: {
                min: '.min.js'
            }
        }))
        .pipe(gulp.dest(paths.dist.js));
});

// gulp.task('imgCopy', async function() {
//     gulp.src(paths.src.img)
//         .pipe(imagemin())
//         .pipe(gulp.dest(paths.dist.img));
// });

// gulp.task('img', async function() {
//     gulp.src(paths.src.img)
//         .pipe(webp())
//         .pipe(imagemin())
//         .pipe(gulp.dest(paths.dist.img));
// });

gulp.task('watch', function() {
    gulp.watch(paths.src.scss, gulp.series('sass'));
    gulp.watch(paths.src.js, gulp.series('js'));
    // gulp.watch(paths.src.img, gulp.series('imgCopy'));
    // gulp.watch(paths.src.img, gulp.series('img'));
});