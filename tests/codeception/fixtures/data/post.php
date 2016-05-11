<?php

return [
    [
        'id' => 1,
        'title' => 'npm — 包管理器',
        'content' => '#npm — 包管理器 

@(Guide with React)

---

[TOC]


官方文档：https://docs.npmjs.com/

##npm是什么？
npm是node.js的包管理工具，它包括命令行下的npm工具与存放代码包的npm平台。

- 它可以让你轻松使用其他js开发者的代码
- 也可以把你的代码分享给他们
- 它还能让你轻松管理不同版本的代码

##安装npm
在node.js官网下载并且安装node.js，npm会附带安装。

升级npm:

	sudo npm install npm -g

查看版本：
	
	npm -v

##安装npm包

有两种方式安装npm包：**本地(locally)** 与 **全局(globally)**
使用哪种方式取决于你想怎么使用包：
- 如果你想在本地代码中依赖一个包，例如：require(\'jquery\')，那就使用本地安装方式
- 如果你想使用包作为一个命令行工具，例如：grunt 命令行，那就使用全局安装方式

###本地安装／使用／更新／卸载包

####安装

	npm install <package_name>
	
这条命令执行后，将在当前目录创建一个 "node_modules" 目录。
然后把包下载到这个目录里。

**安装包的版本**

- 如果当前目录没有 package.json 文件，将会安装包的最新版本（ latest version）
- 如果有 package.json 文件，将会按照 package.json 中的规则安装

####使用
安装 uniq 包
	
	npm install uniq 

创建一个文件：index.js
		
	//index.js
	var uniq = require(\'uniq\');
	var arr = [1,2,1,2,3,4,3];
	console.log(uniq(arr));
	
使用 node 在命令行中运行这个文件
	
	node index.js
	
	//输出：
	[ 1, 2, 3, 4 ]

####使用 package.json 
管理本地包的最好方式是创建一个 package.json  文件.
这样做有许多好处：

- 可以用文件的方式描述你项目的依赖包
- 允许你指定依赖包的版本，可以使用语义化版本 [semantic versioning rules](https://docs.npmjs.com/getting-started/semantic-versioning) 规则
- 你可以把 package.json  文件分享给其他开发者，这样可以让别人轻松构建
	
#####创建 package.json
运行命令

	npm init --yes

执行完后将在当前目录生成一个 package.json 文件

	{
	  "name": "browserify",
	  "version": "1.0.0",
	  "description": "",
	  "main": "index.js",
	  "dependencies": {},
	  "devDependencies": {},
	  "scripts": {
	    "test": "echo \"Error: no test specified\" && exit 1"
	  },
	  "keywords": [],
	  "author": "",
	  "license": "ISC"
	}

- name 项目名 (`必填`)
- version 版本号 （`必填`）
- description 项目描述，帮助其他人在npm平台上搜索到你的项目（npm search）
- main 当你的包被别人requrie后，默认执行的入口文件
- dependencies 依赖的包列表
- devDependencies 开发环境依赖的包列表
- scripts
- keywords 项目关键字, npm search 用到
- author 项目作者，包括：name，email，url
- license 开源协议
	
#####指定依赖包
你可以在 package.json 文件中列出你需要依赖的包，这里有两个字段可以使用：
- **"dependencies"**：你在生产环境中需要依赖的包
- **"devDependencies"**：你在开发或测试时需要依赖的


例子：

	{
	  "name": "my_package",
	  "version": "1.0.0",
	  "dependencies": {
	    "my_dep": "^1.0.0"
	  },
	  "devDependencies" : {
	    "my_test_framework": "^3.1.0"
	  }
	}

#####安装依赖包
运行  npm install 可以安装所有的依赖包
另外在安装依赖包时有两个flag可以使用：--save 和 --save-dev
	
	//依赖包名将被保存到 dependencies 中 
	npm install <package_name> --save
	
	//依赖包名将被保存到 devDependencies 中 
	npm install <package_name> --save-dev
	
#####管理依赖包版本
npm 使用语义化版本号规则（Semantic Versioning）来描述依赖包的版本 ，可以查看  [Getting Started "Semver" page](https://docs.npmjs.com/getting-started/semantic-versioning) 学习

####更新
你应该经常更新你依赖的包，使用 `npm outdated` 可以查看哪些包过时了

	npm outdated
	
	//如果有过时的包，也许会输出
	Package  Current  Wanted  Latest  Location
	jquery    1.12.2  1.12.1   2.2.2  browserify
	
	//如果你的包都是最新的，这条命令什么也不会输出
	
然后你可以更新过时的包
	
	npm update		

####卸载
你可以把 node_modules 目录中的包卸载掉。

	npm uninstall <package_name>

但是这样做没有更新 package.json，所以你要加上 `--save` flag
	
	npm uninstall --save <package_name> 

###全局安装/更新/卸载npm包

####安装
全局安装与本地安装的区别，就是多了个 `-g` flag,

	npm install -g <package_name>

如果这条命令执行报错，那可能是你没有权限，加上 `sudo`再试一下

	sudo npm install -g <package_name>

####更新

你可以使用下面的命令看看哪些包过时了
	
	npm outdated -g --depth=0

然后你可以更新某个过时的包

	npm install -g <package_name>

你也可以更新所有过时的包

	npm update -g

####卸载
你可以用下面的命令卸载全局包
	
	npm uninstall -g <package_name>
	
##创建与发布npm包

###编写node.js模块

新建一个文件夹，比如：npm-test，然后进入该文件夹

初始化 package.json
	
	npm init --yes

新建js文件，比如：index.js
	
		exports.sayHello = function(){
	　　　　 return "Hello,leo.";
	　　 };

 >注意：index.js 应该与 package.json 中"main"字段一致，这是你项目的入口文件，别人require() 你的包时，npm会自动加载这个文件。

###发布npm包

发布之前你要在 npm 平台上注册一个 "用户"，可以使用下面的命令
	
	npm adduser

如果你注册成功，你还需要登录npm，把你的证书(credentail)保存在客户端
	
	npm login
	
	//例如：
	Username:leo_in_china
	Password: ****
	Email: (this IS public) 708833018@qq.com
	Logged in as leo_in_china on https://registry.npmjs.org/.
	
然后你就可以使用下面这条命令发布你的包了

	npm publish

>如果发布失败，并且提示："you do not have permission to publish..."，这个错误是因为你的包名字已经被别人使用了，修改一下 package.json 的 name 字段，换个比较奇葩没人用的名字，再发布一遍。

你可以登录到npm平台的个人中心，看看你刚发布的包
地址：https://www.npmjs.com/~

###更新你的npm包

当你修改了代码，你可能想更新一下版本，使用下面这条命令

	npm version <update_type>

update_type 可以是 "semantic versioning release types" 中的一个，比如：`patch`, `minor`, 或者 `major`

这条命令执行后，会改变 package.json 文件中的版本号。

更新了版本后，你可以再次使用 `npm publish` 发布你的新版本。


##语义化版本号 (Sematic Versioning)
Semantic versioning 是一个描述项目版本号的标准规范，npm也在使用这个规范。Semantic versioning也简称`"Semver"`。

###npm包发布者如何使用 Semver
一个项目的初始版本号应该是 **1.0.0**。
在此之后，每一次发布新版本，版本号应该遵循以下规则：
- bug修复或者其他较小更新： Patch release（补丁版本），最后一位数字加1，比如：1.0.1
- 添加新特性并且兼容老版本：Minor release（新特性版本），中位数字加1，比如：1.1.0
- 重大改版并且不兼容老版本：Major release (重大更新版本)，第一位数字加1，比如 ：2.0.0
###npm包使用者如何使用 Semver
作为一个包的使用者，你可以在 package.json 文件中指定你的app依赖哪种类型的包。

如果你依赖一个1.0.4版本的包，你可以这样指定范围：
- (只接受bug修复或小改动更新) **Patch releases: 1.0 or 1.0.x or ~1.0.4**
- (可以接受新特性更新，但是要兼容现在版本 ) **Minor releases: 1 or 1.x or ^1.0.4 **`推荐`
- (接受任何更新，不论是否兼容现在版本) **Major releases: * or x**

你可以查看这个文档，了解**更细粒度的版本号**指定. https://docs.npmjs.com/misc/semver
语义化版本 2.0.0: http://semver.org/lang/zh-CN/


##使用 scoped 包
Scopes 就像是 npm 模块的命名空间(namespaces)一样。如果一个包名以`@`符号开始，那么它就是一个 scoped 包

	@scope/project-name

每个在npm上注册过的用户都有它自己的 scope
	
	@username/project-name
	
你可以在这里找到关于 scopes 更深度的文档：https://docs.npmjs.com/misc/scope#publishing-public-scoped-packages-to-the-public-npm-registry

###初始化／发布／使用 scoped 包
第一次使用scoped包需要先登录
	
	npm login
	
####初始化
要修改当前的包为scoped包，你可以直接修改 package.json 的 name 字段
	
	{
	  "name": "@username/project-name"
	}

你也可以使用 `npm init` 初始化一个 scoped 包
	
	npm init  --yes --scope==username

 如果你大部分时间都使用同一个 scope，你可能想把这个选项设置进你的 .npmrc file
	 
	npm config set scope username

####发布包
发布私有的scoped包，你需要在npm上成为付费用户。但是你如果发布公共的(public)包，那就是免费的。
`npm publish `默认是发布私有包，为了发布免费的公共包，你需要加上 --access=public 选项

	npm publish --access=public

####使用包
在 package.json 中
	
	{
	  "dependencies": {
	    "@username/project-name": "^1.0.0"
	  }
	}
在命令行中
	
	npm install @username/project-name --save

在 js 的 require 中
	
	var projectName = require("@username/project-name")


',
        'tags' => 'php',
        'created_at' => 394554930,
        'updated_at' => 1050435357,
        'status' => 3,
        'author_id' => 1,
    ],
    [
        'id' => 2,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1437705393,
        'updated_at' => 1264359045,
        'status' => 1,
        'author_id' => 2,
    ],
    [
        'id' => 3,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 544744615,
        'updated_at' => 133069919,
        'status' => 1,
        'author_id' => 3,
    ],
    [
        'id' => 4,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 538361731,
        'updated_at' => 1045527536,
        'status' => 1,
        'author_id' => 4,
    ],
    [
        'id' => 5,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1211151323,
        'updated_at' => 1420729278,
        'status' => 3,
        'author_id' => 5,
    ],
    [
        'id' => 6,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 662109831,
        'updated_at' => 49330350,
        'status' => 3,
        'author_id' => 6,
    ],
    [
        'id' => 7,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1367937978,
        'updated_at' => 760013051,
        'status' => 2,
        'author_id' => 7,
    ],
    [
        'id' => 8,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 457368971,
        'updated_at' => 9247940,
        'status' => 3,
        'author_id' => 8,
    ],
    [
        'id' => 9,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1242623562,
        'updated_at' => 87811547,
        'status' => 2,
        'author_id' => 9,
    ],
    [
        'id' => 10,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 433587974,
        'updated_at' => 1175183464,
        'status' => 2,
        'author_id' => 10,
    ],
    [
        'id' => 11,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 504470992,
        'updated_at' => 1434919044,
        'status' => 3,
        'author_id' => 11,
    ],
    [
        'id' => 12,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 735098115,
        'updated_at' => 872407722,
        'status' => 3,
        'author_id' => 12,
    ],
    [
        'id' => 13,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 537364983,
        'updated_at' => 749737736,
        'status' => 1,
        'author_id' => 13,
    ],
    [
        'id' => 14,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 971608269,
        'updated_at' => 1198796626,
        'status' => 2,
        'author_id' => 14,
    ],
    [
        'id' => 15,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1395545060,
        'updated_at' => 767359007,
        'status' => 2,
        'author_id' => 15,
    ],
    [
        'id' => 16,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1182329710,
        'updated_at' => 404420589,
        'status' => 3,
        'author_id' => 16,
    ],
    [
        'id' => 17,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1452825643,
        'updated_at' => 1048809137,
        'status' => 1,
        'author_id' => 17,
    ],
    [
        'id' => 18,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 737777315,
        'updated_at' => 1110940533,
        'status' => 3,
        'author_id' => 18,
    ],
    [
        'id' => 19,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1098841508,
        'updated_at' => 1414024813,
        'status' => 3,
        'author_id' => 19,
    ],
    [
        'id' => 20,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 894147123,
        'updated_at' => 880095719,
        'status' => 1,
        'author_id' => 20,
    ],
    [
        'id' => 21,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 738391786,
        'updated_at' => 1261259983,
        'status' => 2,
        'author_id' => 21,
    ],
    [
        'id' => 22,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 302834753,
        'updated_at' => 771202352,
        'status' => 3,
        'author_id' => 22,
    ],
    [
        'id' => 23,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 393335726,
        'updated_at' => 452727454,
        'status' => 3,
        'author_id' => 23,
    ],
    [
        'id' => 24,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 402278383,
        'updated_at' => 197119268,
        'status' => 3,
        'author_id' => 24,
    ],
    [
        'id' => 25,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 888620559,
        'updated_at' => 1144076787,
        'status' => 3,
        'author_id' => 25,
    ],
    [
        'id' => 26,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 813787596,
        'updated_at' => 1279140865,
        'status' => 2,
        'author_id' => 26,
    ],
    [
        'id' => 27,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 861293588,
        'updated_at' => 1422528766,
        'status' => 2,
        'author_id' => 27,
    ],
    [
        'id' => 28,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1438658541,
        'updated_at' => 204594319,
        'status' => 2,
        'author_id' => 28,
    ],
    [
        'id' => 29,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 380286822,
        'updated_at' => 561979435,
        'status' => 2,
        'author_id' => 29,
    ],
    [
        'id' => 30,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1461111879,
        'updated_at' => 150464910,
        'status' => 3,
        'author_id' => 30,
    ],
    [
        'id' => 31,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 938741678,
        'updated_at' => 790944455,
        'status' => 1,
        'author_id' => 31,
    ],
    [
        'id' => 32,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1205537913,
        'updated_at' => 363756896,
        'status' => 1,
        'author_id' => 32,
    ],
    [
        'id' => 33,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1260498922,
        'updated_at' => 697692404,
        'status' => 1,
        'author_id' => 33,
    ],
    [
        'id' => 34,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1011696519,
        'updated_at' => 739914386,
        'status' => 3,
        'author_id' => 34,
    ],
    [
        'id' => 35,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1203648380,
        'updated_at' => 1119597828,
        'status' => 2,
        'author_id' => 35,
    ],
    [
        'id' => 36,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 882289809,
        'updated_at' => 1051840725,
        'status' => 2,
        'author_id' => 36,
    ],
    [
        'id' => 37,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 451667997,
        'updated_at' => 1048934440,
        'status' => 1,
        'author_id' => 37,
    ],
    [
        'id' => 38,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 358419242,
        'updated_at' => 1266422499,
        'status' => 3,
        'author_id' => 38,
    ],
    [
        'id' => 39,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 329268800,
        'updated_at' => 1375377514,
        'status' => 1,
        'author_id' => 39,
    ],
    [
        'id' => 40,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 129581651,
        'updated_at' => 1391169731,
        'status' => 3,
        'author_id' => 40,
    ],
    [
        'id' => 41,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 727428677,
        'updated_at' => 1345608718,
        'status' => 2,
        'author_id' => 41,
    ],
    [
        'id' => 42,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1129631285,
        'updated_at' => 1338883913,
        'status' => 3,
        'author_id' => 42,
    ],
    [
        'id' => 43,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1217043925,
        'updated_at' => 1343443011,
        'status' => 1,
        'author_id' => 43,
    ],
    [
        'id' => 44,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 510258018,
        'updated_at' => 1091299010,
        'status' => 2,
        'author_id' => 44,
    ],
    [
        'id' => 45,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 414009606,
        'updated_at' => 1178580996,
        'status' => 2,
        'author_id' => 45,
    ],
    [
        'id' => 46,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 915984548,
        'updated_at' => 277368724,
        'status' => 1,
        'author_id' => 46,
    ],
    [
        'id' => 47,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1112619008,
        'updated_at' => 264002415,
        'status' => 3,
        'author_id' => 47,
    ],
    [
        'id' => 48,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 400288472,
        'updated_at' => 801406930,
        'status' => 1,
        'author_id' => 48,
    ],
    [
        'id' => 49,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 910035942,
        'updated_at' => 1157706899,
        'status' => 1,
        'author_id' => 49,
    ],
    [
        'id' => 50,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 499523177,
        'updated_at' => 493410311,
        'status' => 1,
        'author_id' => 50,
    ],
    [
        'id' => 51,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1120173875,
        'updated_at' => 970777347,
        'status' => 3,
        'author_id' => 51,
    ],
    [
        'id' => 52,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1420930873,
        'updated_at' => 1414070649,
        'status' => 2,
        'author_id' => 52,
    ],
    [
        'id' => 53,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 382648371,
        'updated_at' => 625925257,
        'status' => 2,
        'author_id' => 53,
    ],
    [
        'id' => 54,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 523535769,
        'updated_at' => 409469043,
        'status' => 3,
        'author_id' => 54,
    ],
    [
        'id' => 55,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1422400647,
        'updated_at' => 913107677,
        'status' => 1,
        'author_id' => 55,
    ],
    [
        'id' => 56,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 699531424,
        'updated_at' => 298976803,
        'status' => 3,
        'author_id' => 56,
    ],
    [
        'id' => 57,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1259203992,
        'updated_at' => 734515046,
        'status' => 2,
        'author_id' => 57,
    ],
    [
        'id' => 58,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1381610362,
        'updated_at' => 1199095107,
        'status' => 2,
        'author_id' => 58,
    ],
    [
        'id' => 59,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 240465493,
        'updated_at' => 1243624965,
        'status' => 1,
        'author_id' => 59,
    ],
    [
        'id' => 60,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 881457150,
        'updated_at' => 321474122,
        'status' => 1,
        'author_id' => 60,
    ],
    [
        'id' => 61,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 163033981,
        'updated_at' => 413913918,
        'status' => 1,
        'author_id' => 61,
    ],
    [
        'id' => 62,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 820100879,
        'updated_at' => 310207765,
        'status' => 3,
        'author_id' => 62,
    ],
    [
        'id' => 63,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 811581187,
        'updated_at' => 1249765813,
        'status' => 2,
        'author_id' => 63,
    ],
    [
        'id' => 64,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1120736909,
        'updated_at' => 701175117,
        'status' => 1,
        'author_id' => 64,
    ],
    [
        'id' => 65,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1306128831,
        'updated_at' => 15934585,
        'status' => 3,
        'author_id' => 65,
    ],
    [
        'id' => 66,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 227804591,
        'updated_at' => 26424126,
        'status' => 2,
        'author_id' => 66,
    ],
    [
        'id' => 67,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 855522797,
        'updated_at' => 266939767,
        'status' => 3,
        'author_id' => 67,
    ],
    [
        'id' => 68,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 936462857,
        'updated_at' => 18807007,
        'status' => 2,
        'author_id' => 68,
    ],
    [
        'id' => 69,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1078128292,
        'updated_at' => 244062359,
        'status' => 1,
        'author_id' => 69,
    ],
    [
        'id' => 70,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 889027947,
        'updated_at' => 981955120,
        'status' => 1,
        'author_id' => 70,
    ],
    [
        'id' => 71,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 853137265,
        'updated_at' => 984240030,
        'status' => 2,
        'author_id' => 71,
    ],
    [
        'id' => 72,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1397469505,
        'updated_at' => 171499845,
        'status' => 2,
        'author_id' => 72,
    ],
    [
        'id' => 73,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 5666610,
        'updated_at' => 223894487,
        'status' => 2,
        'author_id' => 73,
    ],
    [
        'id' => 74,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1046589472,
        'updated_at' => 992375198,
        'status' => 1,
        'author_id' => 74,
    ],
    [
        'id' => 75,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1250290589,
        'updated_at' => 692567175,
        'status' => 3,
        'author_id' => 75,
    ],
    [
        'id' => 76,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1208598553,
        'updated_at' => 521727294,
        'status' => 3,
        'author_id' => 76,
    ],
    [
        'id' => 77,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 912087763,
        'updated_at' => 866712663,
        'status' => 2,
        'author_id' => 77,
    ],
    [
        'id' => 78,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1198775828,
        'updated_at' => 989061170,
        'status' => 1,
        'author_id' => 78,
    ],
    [
        'id' => 79,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1402861140,
        'updated_at' => 771486501,
        'status' => 3,
        'author_id' => 79,
    ],
    [
        'id' => 80,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1387400846,
        'updated_at' => 1423081177,
        'status' => 2,
        'author_id' => 80,
    ],
    [
        'id' => 81,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 439848166,
        'updated_at' => 632491852,
        'status' => 3,
        'author_id' => 81,
    ],
    [
        'id' => 82,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 640149025,
        'updated_at' => 863926515,
        'status' => 1,
        'author_id' => 82,
    ],
    [
        'id' => 83,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 24225948,
        'updated_at' => 525701256,
        'status' => 3,
        'author_id' => 83,
    ],
    [
        'id' => 84,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 761969418,
        'updated_at' => 652001809,
        'status' => 1,
        'author_id' => 84,
    ],
    [
        'id' => 85,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 622828967,
        'updated_at' => 1349680788,
        'status' => 3,
        'author_id' => 85,
    ],
    [
        'id' => 86,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1074493653,
        'updated_at' => 1079567667,
        'status' => 2,
        'author_id' => 86,
    ],
    [
        'id' => 87,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 276176462,
        'updated_at' => 248371575,
        'status' => 1,
        'author_id' => 87,
    ],
    [
        'id' => 88,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 953815345,
        'updated_at' => 46401880,
        'status' => 3,
        'author_id' => 88,
    ],
    [
        'id' => 89,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1403585658,
        'updated_at' => 633360813,
        'status' => 3,
        'author_id' => 89,
    ],
    [
        'id' => 90,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 336740637,
        'updated_at' => 438435950,
        'status' => 3,
        'author_id' => 90,
    ],
    [
        'id' => 91,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 768421775,
        'updated_at' => 1264195623,
        'status' => 1,
        'author_id' => 91,
    ],
    [
        'id' => 92,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 505933732,
        'updated_at' => 41899443,
        'status' => 2,
        'author_id' => 92,
    ],
    [
        'id' => 93,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 533295335,
        'updated_at' => 446980141,
        'status' => 1,
        'author_id' => 93,
    ],
    [
        'id' => 94,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 563965900,
        'updated_at' => 1301821344,
        'status' => 2,
        'author_id' => 94,
    ],
    [
        'id' => 95,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 31146604,
        'updated_at' => 609532006,
        'status' => 3,
        'author_id' => 95,
    ],
    [
        'id' => 96,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 733040202,
        'updated_at' => 1297655694,
        'status' => 3,
        'author_id' => 96,
    ],
    [
        'id' => 97,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 942814065,
        'updated_at' => 584888061,
        'status' => 1,
        'author_id' => 97,
    ],
    [
        'id' => 98,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 1317226595,
        'updated_at' => 346166527,
        'status' => 2,
        'author_id' => 98,
    ],
    [
        'id' => 99,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 908119055,
        'updated_at' => 606454332,
        'status' => 3,
        'author_id' => 99,
    ],
    [
        'id' => 100,
        'title' => '前端工具与框架',
        'content' => '##模块加载器
- RequireJS (AMD 动态编译)
- seaJs  (CMD 动态编译)
- Browerify (commonJs 静态编译)
- Webpack
##包管理器
- npm
- bower
##自动部署/编译/构建流水线
- grunt
- gulp
##UI框架
- Bootstrap
- Semantic UI
- sui
- AmazeUI
##css预处理语言
- less
- sass
##js预处理语言
- CoffeeScript 
- TypeScript
##js框架
- angularjs
- React
- vue.js
',
        'tags' => 'php',
        'created_at' => 229891070,
        'updated_at' => 894354377,
        'status' => 1,
        'author_id' => 100,
    ],
];
