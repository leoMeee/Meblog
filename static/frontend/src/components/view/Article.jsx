import React from 'react';
import {markdown} from 'markdown'
import Highlight from '../../libs/react-highlight';
import 'github-markdown-css'

class Article extends React.Component {

    render() {
        return (
            <article className="markdown-body">
                <div className="row">
                    <div className="col-md-10 col-md-offset-1">
                        <div className="panel panel-default">
                            <div className="panel-body">
                                <Highlight innerHTML={true}>
                                    {markdown.toHTML(this.props.content.toString())}
                                </Highlight>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        )
    }
}

export default Article;