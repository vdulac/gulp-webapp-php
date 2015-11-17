Download, then:
$ npm cache clear
$ npm install
$ bower install

This version works with XAMPP -> PHP, MySQL, htaccess!

No need to move any folder/file.
No need to edit any file, except gulpfile.babel.js
Based off this: http://stackoverflow.com/questions/33728041/browser-sync-php-and-htaccess

From CLI:
$ npm install --save http-proxy 			<= would '--save-dev' also work? 

Add to gulpfile.babel.js:
import httpProxy from 'http-proxy';

gulp.task('serve-php', ['styles', 'fonts'], () => {
  const proxy = httpProxy.createProxyServer({});
  browserSync({
    notify: false,
    port: 9000,
    ui: {
        port: 9001
    },
    server: {
      baseDir: ['.tmp', 'app'],
      routes: {
        '/bower_components': 'bower_components'
      },
      middleware: function (req, res, next) {
        var url = req.url;
        if (!url.match(/^\/(styles|fonts|bower_components)\//)) {
          proxy.web(req, res, { target: 'http://xamppvhost.dev' });
        }
        else {
          next();
        }
      }
    }
  });

  gulp.watch([
    'app/**/*.html',
    'app/**/*.php',
    'app/scripts/**/*.js',
    'app/images/**/*',
    '.tmp/fonts/**/*'
  ]).on('change', reload);

  gulp.watch('app/styles/**/*.scss', ['styles']);
  gulp.watch('app/fonts/**/*', ['fonts']);
  gulp.watch('bower.json', ['wiredep', 'fonts']);
});


Start XAMPP (Apache, MySQL)
Create the vhost from httpd-vhosts.conf & HOST file.
ex: servephp.dev & servephpdist.dev

Run 'gulp serve-php'
Run 'gulp serve-php:dist'

##### Pour que BrowserSync fonctionne, il faut que la page ait un <body> et qu'il n'y ait pas de content avant le <!DOCTYPE html><html ...>
##### Browsersync autoreload ne fonctionne pas pour gulp serve-php:dist

-------------------------------

Quand j'ajoute un package avec:
bower install font-awesome -S
runner ensuite gulp wiredep
