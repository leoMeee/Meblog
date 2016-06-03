import React from 'react';

class Footer extends React.Component {

    render() {
        return (
            <footer>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <p className="copyright text-muted">Copyright &copy;{this.props.name} 2016</p>
                        </div>
                    </div>
                </div>
            </footer>
        )
    }
}

export default Footer;