import React from 'react';

class Loading extends React.Component {

    render() {
        let loadClass = 'loading '+this.props.style;
        return (
            <div className={loadClass}>
                <div className="spinner">
                    <div className="double-bounce1"></div>
                    <div className="double-bounce2"></div>
                </div>
            </div>
        )
    }
}

export default Loading;