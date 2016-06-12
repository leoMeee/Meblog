<?php
namespace app\modules\frontendApi\controllers;

use yii\rest\Controller;
use Yii;

class PostController extends Controller
{

    public function actionIndex()
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 2,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 3,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],[
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],

            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'id' => 4,
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],

        ];

        return $posts;
    }

    public function actionView($id)
    {
        return array(
            'id' => $id,
            'title' => 'linux从入门到精通',
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
            'created_at' => time(),
            'updated_at' => time(),
        );
    }

}
