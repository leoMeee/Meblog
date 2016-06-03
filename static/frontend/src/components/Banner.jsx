import React from 'react';

class Banner extends React.Component {

    render() {
        return (
            <header className="intro-header"
                    style={{backgroundImage: 'url("'+this.props.img+'")'}}>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            {this.props.children}
                        </div>
                    </div>
                </div>
            </header>
        )
    }
}

export default Banner;