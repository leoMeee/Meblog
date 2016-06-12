import React from 'react';
import {markdown} from 'markdown'

class Article extends React.Component {
    rawMarkup() {
        var rawMarkup = markdown.toHTML(this.props.content.toString());
        return {__html: rawMarkup};
    }

    render() {
        return (
            <article className="markdown-body">
                <div className="row">
                    <div className="col-md-10 col-md-offset-1">
                        <div className="panel panel-default">
                            <div className="panel-body" dangerouslySetInnerHTML={this.rawMarkup()}>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        )
    }
}

export default Article;