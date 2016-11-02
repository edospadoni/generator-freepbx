'use strict';
var yeoman = require('yeoman-generator');
var chalk = require('chalk');
var yosay = require('yosay');
var mkdirp = require('mkdirp');

module.exports = yeoman.Base.extend({
  prompting: function() {
    // Have Yeoman greet the user.
    this.log(yosay(
      'Welcome to the ' + chalk.green('FreePBX') + ' module generator!'
    ));

    var prompts = [{
      type: 'input',
      name: 'name',
      message: 'FreePBX module name (raw)',
      default: this.appname
    }, {
      type: 'input',
      name: 'description',
      message: 'FreePBX module description',
      default: this.appname.charAt(0).toUpperCase() + this.appname.slice(1)
    }, {
      type: 'input',
      name: 'long_description',
      message: 'FreePBX module long description'
    }, {
      type: 'input',
      name: 'author',
      message: 'FreePBX module author'
    }, {
      type: 'list',
      name: "category",
      message: "FreepBX module category",
      choices: [{
        name: 'Applications',
        value: 'Applications'
      }, {
        name: 'Connectivity',
        value: 'Connectivity'
      }, {
        name: 'Dashboard',
        value: 'Dashboard'
      }, {
        name: 'Reports',
        value: 'Reports'
      }, {
        name: 'Settings',
        value: 'Settings'
      }]
    }];

    return this.prompt(prompts).then(function(props) {
      this.name = props.name;
      this.description = props.description;
      this.long_description = props.long_description;
      this.author = props.author;
      this.category = props.category;
    }.bind(this));
  },

  writing: function() {
    mkdirp('views');
    mkdirp('assets/js');
    mkdirp('assets/css');
    mkdirp('i18n');
    mkdirp('images');

    this.copy('_assets/_js/_module.js', 'assets/js/' + this.name + '.js');

    this.copy('_views/_bootnav.php', 'views/bootnav.php');
    this.copy('_views/_default.php', 'views/default.php');
    this.copy('_views/_form.php', 'views/form.php');
    this.copy('_views/_grid.php', 'views/grid.php');

    this.copy('_install.php', 'install.php');
    this.copy('_LICENSE', 'LICENSE');
    this.copy('_Module.class.php', this.name.charAt(0).toUpperCase() + this.name.slice(1) + '.class.php');
    this.copy('_module.xml', 'module.xml');
    this.copy('_page.module.php', 'page.' + this.name + '.php');
    this.copy('_README.md', 'README.md');
    this.copy('_uninstall.php', 'uninstall.php');
  },

  install: function() {
    this.installDependencies();
  }
});