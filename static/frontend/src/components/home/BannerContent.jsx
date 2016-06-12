import React from 'react';

class BannerContent extends React.Component {

    render() {
        return (
            <div className="site-heading">
                <div className="ui small sequenced images">
                    <img src={this.props.avatar} className="ui circular image" />
                </div>
                <span className="subheading">{this.props.say}</span>
            </div>
        )
    }
}

export default BannerContent;