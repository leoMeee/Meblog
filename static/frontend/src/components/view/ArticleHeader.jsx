import React from 'react';
import DateFormatter from '../../libs/DateFormatter';

class ArticleHeader extends React.Component {
    render() {
        return (
            <div className="post-heading">
                <h2 className="subheading">{this.props.title}</h2>
                <span className="meta">更新于 {DateFormatter(this.props.updated_at)}</span>
            </div>
        )
    }
}
export default ArticleHeader;