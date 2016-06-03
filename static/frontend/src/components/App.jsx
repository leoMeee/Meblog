import React from 'react';
import Navigation from './Navigation';
import Banner from './Banner';
import BannerContent from './BannerContent';
import PostLists from './PostLists';
import Footer from  './Footer';

class App extends React.Component {

    render() {
        return (
            <div className="main">
                <Navigation {...this.props.app}/>
                <Banner {...this.props.banner}>
                    <BannerContent {...this.props.user}/>
                </Banner>
                <div className="container">
                    <PostLists posts={this.props.posts}/>
                </div>
                <hr/>
                <Footer {...this.props.app}/>
            </div>
        )
    }

}

export default App;