import React from 'react';


class ArticleHeader extends React.Component {
    render() {
        return (
            <div className="post-heading">
                <h2 className="subheading">{this.props.title}</h2>
                <span className="meta">更新于 {this.props.updated_at}</span>
            </div>
        )
    }
}
export default ArticleHeader;