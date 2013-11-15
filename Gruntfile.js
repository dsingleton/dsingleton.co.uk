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
    },

    'gh-pages': {
      options: {
        base: 'dist',
        message:'Automatically generated gh-pages update',
        silent: true
      },
      src: ['**']
    }
  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-gh-pages');

  grunt.registerTask('build', [
    'copy:dist',
  ]);

  grunt.registerTask('server', [
    'build',
    'connect:dist'
  ]);

  grunt.registerTask('deploy', [
    'build',
    'gh-pages'
  ]);
};
