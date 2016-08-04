var admin_dir = 'bacon';
module.exports = function(grunt) {
    var npmTasks = ['grunt-contrib-watch', 'grunt-contrib-copy', 'grunt-sync', 'grunt-contrib-compress'];
    npmTasks.forEach(function(task){
        grunt.loadNpmTasks(task);
    });

    grunt.initConfig({
        watch: {
            wordpress: {
                files: ['src/**'],
                tasks: ['sync'/*'copy:updatedocker'*/]
            }
        },/*
        copy: {
            updatedocker: {
                files: [
                    {expand: true, cwd: 'src', src: ['**'], dest: 'docker_root/wp-content/plugins/drafts-for-friends', dot: true}
                ]
            }
        },*/
        sync: {
            main: {
                files: [{
                    cwd: 'src/YOUR_ADMIN',
                    src: ['**'],
                    dest: './docker_root/' + admin_dir
                },{
                    cwd: 'src/includes',
                    src: ['**'],
                    dest: './docker_root/includes'
                }
                ],
                updateAndDelete: false,
                // compareUsing: "md5",
                /*pretend: true,*/
                verbose: true // Display log messages when copying files
            }
        },
        compress: {
            build: {
                options: {
                    archive: 'build/liveengage_oscommerce.zip'
                },

                files: [
                    {expand: true, cwd: 'src/', src: ['**'], dest: './catalog' },
                    {expand: true, cwd: 'docs/', src: ['**', '!*.tpl'], dest: '.'}
                ]
            }
        }

    });
    grunt.registerTask('default', ['sync', 'watch']);
    grunt.registerTask('build', ['compress:build']);
};