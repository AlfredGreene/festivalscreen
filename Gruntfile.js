//Gruntfile
module.exports = function(grunt) {

    //Initializing the configuration object
    grunt.initConfig({

        // Task configuration
        less: {
            development: {
                options: {
                  compress: true,  //minifying the result
                },
                files: {
                  //compiling frontend.less into frontend.css
                  "./public/assets/css/styles.css"    :   "./app/assets/css/styles.less",
                }
            }
        },
        watch: {
            less: {
              files: ['./app/assets/css/*.less'],  // watched files
              tasks: ['less'],                     // tasks to run
              options: {
                livereload: true                   // reloads the browser
              }
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');


    // Task definition
    grunt.registerTask('default', ['watch']);

};