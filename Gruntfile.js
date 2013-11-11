module.exports = function(grunt) {
  grunt.initConfig({
		copy: {
      dist: {
        files: [{
          expand: true,
          dot: true,
          cwd: 'app',
          dest: 'dist',
          src: ['**/*']
        }]
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-copy');

  grunt.registerTask('build', [
    'copy:dist',
  ]);

};
