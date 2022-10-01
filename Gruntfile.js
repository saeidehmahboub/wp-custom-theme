'use strict';
module.exports = function(grunt)
{
    grunt.initConfig(
    {
        watch: {
            sass: {
                files: ['assets/scss/*.scss'],
                tasks: ['sass', 'cssmin']
            },
            js: {
                files: ['assets/js/scripts.js'],
                tasks: ['uglify']
            }
        },
        uglify: {
            options: {},
            target: {
                files: {
                    'assets/js/scripts.min.js': ['assets/js/scripts.js'],
                }
            }
        },
        sass: {
            options: {},
            dist: {
                files: {
					'assets/css/styles.css': ['assets/scss/styles.scss'],
                }
            }
        },
        cssmin: {
            sitecss: {
                options: {
                    banner: ''
                },
                files: {
                    'assets/css/styles.min.css': ['assets/css/styles.css'],
                }
            }
        }
    });

    // Load Task
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify-es');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Register Task
    grunt.registerTask('default', ['uglify', 'sass', 'cssmin']);
};