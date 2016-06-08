import React from 'react';

class Navigation extends React.Component {

    render() {
        let menusNode = this.props.menus.map(function (menu, key) {
            return <Menu {...menu}  />
        });
        return (
            <nav className="navbar navbar-default navbar-custom navbar-fixed-top">
                <div className="container-fluid">
                    <div className="navbar-header page-scroll">
                        <button type="button" className="navbar-toggle" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span className="sr-only">Toggle navigation</span>
                            <span className="icon-bar">&nbsp;</span>
                            <span className="icon-bar">&nbsp;</span>
                            <span className="icon-bar">&nbsp;</span>
                        </button>
                        <a className="navbar-brand" href="/" title="Home">{this.props.siteName}</a>
                    </div>

                    <div className="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul className="nav navbar-nav navbar-right">
                            {menusNode}
                        </ul>
                    </div>
                </div>
            </nav>
        )
    }
}

class Menu extends React.Component {

    render() {
        return (
            <li className="first leaf ">
                <a href={this.props.url} title={this.props.name}>{this.props.name}</a>
            </li>
        )
    }
}

export default Navigation;