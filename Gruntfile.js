module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    cssnext: {
      options: {
        sourcemap: true
      },
      dist: {
        files: {
          "custom.css": "custom.src.css"
        }
      }
    },
    watch: {
          files: ['custom.src.css'],
          tasks: ['style']
        }
  })

  grunt.loadNpmTasks("grunt-cssnext");
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask("style", ["cssnext"]);
  grunt.registerTask("default", ["watch"]);

};