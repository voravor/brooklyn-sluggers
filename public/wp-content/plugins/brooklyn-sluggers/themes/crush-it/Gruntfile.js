module.exports = function(grunt) {
  // time
  require('time-grunt')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        // If you can't get source maps to work, run the following command in your terminal:
        // $ sass scss/foundation.scss:css/foundation.css --sourcemap
        // (see this link for details: http://thesassway.com/intermediate/using-source-maps-with-sass )
        sourceMap: true
      },

      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'css/foundation.css': ['scss/foundation.scss', 'fonts/fontawesome/scss/font-awesome.scss'],
          'css/bs.css': ['scss/foundation.scss', 'fonts/fontawesome/scss/font-awesome.scss']
        }
      }
    },

    copy: {


      scripts: {
        expand: true,
      //  cwd: 'bower_components/foundation/js/vendor/',
        cwd: 'bower_components/',
        src: '**/*.js',
        dest: 'js/vendor'
      },

      iconfonts: {
        expand: true,
        cwd: 'bower_components/fontawesome/',
        src: ['**', '!**/less/**', '!**/css/**', '!bower.json'],
        dest: 'fonts/fontawesome/'
      },

      hover: {
        expand: true,
        cwd: 'bower_components/hover/',
        src: ['**/css/**'],
        dest: 'css/hover'
      }

    },

    'string-replace': {
        inline: {
            files: {
                'fonts/fontawesome/scss/_variables.scss': 'fonts/fontawesome/scss/_variables.scss',
            },
            options: {
                replacements: [
                {
                  pattern: "../fonts",
                  replacement: "../fonts/fontawesome/fonts"
                }
              ]
            }
        }
    },

    concat: {
        options: {
          separator: ';',
        },
        dist: {

          src: [

          'js/vendor/modernizr/modernizr.min.js',
          'js/vendor/fastclick/lib/fastclick.min.js',

          'js/vendor/js-cookie/src/js.cookie.min.js',
          'js/vendor/jquery-visible/jquery.visible.min.js',
          'js/vendor/numeraljs/min/numeral.min.js',
          'js/vendor/dropcap.js/dropcap.min.js',
          'js/vendor/knockout/dist/knockout.js',
          'js/vendor/knockout-validation/dist/knockout.validation.min.js',


          'js/vendor/jquery.lazyload/jquery.lazyload.min.js',
          'js/vendor/jquery-waypoints/lib/jquery.waypoints.min.js',
          'js/vendor/slick-carousel/slick/slick.min.js',

          // Foundation core
          'js/vendor/foundation/js/foundation/foundation.js',

          // Pick the components you need in your project
         // 'js/vendor/foundation/js/foundation/foundation.abide.js',
         // 'js/vendor/foundation/js/foundation/foundation.accordion.js',
         // 'js/vendor/foundation/js/foundation/foundation.alert.js',
          'js/vendor/foundation/js/foundation/foundation.clearing.js',
         // 'js/vendor/foundation/js/foundation/foundation.dropdown.js',
          'js/vendor/foundation/js/foundation/foundation.equalizer.js',
         // 'js/vendor/foundation/js/foundation/foundation.interchange.js',
          'js/vendor/foundation/js/foundation/foundation.joyride.js',
         // 'js/vendor/foundation/js/foundation/foundation.magellan.js',
          'js/vendor/foundation/js/foundation/foundation.offcanvas.js',
         // 'js/vendor/foundation/js/foundation/foundation.orbit.js',
          'js/vendor/foundation/js/foundation/foundation.reveal.js',
         // 'js/vendor/foundation/js/foundation/foundation.slider.js',
         // 'js/vendor/foundation/js/foundation/foundation.tab.js',
         // 'js/vendor/foundation/js/foundation/foundation.tooltip.js',
          'js/vendor/foundation/js/foundation/foundation.topbar.js',
         




        //  'js/vendor/underscore/underscore-min.js',

          // Include your own custom scripts (located in the custom folder)
          'js/custom/*.js'

          ],
          // Finally, concatinate all the files above into one single file
          dest: 'js/bs.js',
        },
      },

    uglify: {
      dist: {
        files: {
          // Shrink the file size by removing spaces
          'js/bs.min.js': ['js/bs.js'],
          'js/vendor/modernizr/modernizr.min.js' : ['js/vendor/modernizr/modernizr.js'],
          'js/vendor/fastclick/lib/fastclick.min.js' : ['js/vendor/fastclick/lib/fastclick.js'],
          'js/vendor/jquery/dist/jquery.min.js' : ['js/vendor/jquery/dist/jquery.js'],
          'js/vendor/js-cookie/src/js.cookie.min.js' : ['js/vendor/js-cookie/src/js.cookie.js']
        }
      }
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: ['scss/**/*.scss', 'fonts/fontawesome/scss/**.scss'],
        tasks: ['sass'],
        options: {
              livereload:35739,
            }
      },

       all: {
        files: '**/*.php',
        options: {
            livereload:35739,
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-string-replace');

  grunt.registerTask('fonts', ['copy:iconfonts', 'string-replace'] );
  grunt.registerTask('build', ['copy', 'fonts', 'sass', 'concat', 'uglify']);

  grunt.registerTask('default', ['watch']);
};
