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
    },

    connect: {
      options: {
        hostname: 'localhost',
        port: 9000
      },
      dist: {
        options: {
          open: true,
          keepalive: true,
          base: 'dist'
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-connect');

  grunt.registerTask('build', [
    'copy:dist',
  ]);

  grunt.registerTask('server', [
    'build',
    'connect:dist'
  ]);
};
