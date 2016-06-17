import React from 'react';
import {Link} from 'react-router';
import classNames from  'classnames';
import  smoothScroll from 'smoothscroll';

class Pager extends React.Component {

    handleClick(page, event) {
        event.target.blur();
        if (page >= 1 && page != this.props.currentPage) {
            this.props.handleClick.bind(this, page)()
                .then(()=>smoothScroll(document.querySelector('.container')))
        }
    }

    render() {
        let {pageCount, currentPage} = this.props;
        let prev = currentPage - 1 < 1 ? '' : currentPage - 1;
        let next = currentPage + 1 > pageCount ? currentPage : currentPage + 1;

        let prevClasses = classNames('p', {
            disabled: currentPage <= 1
        });
        let nextClasses = classNames('p', {
            disabled: currentPage >= pageCount
        });

        return (
            <ul className="pager">
                <li >
                    <Link to={'/'+prev} onClick={this.handleClick.bind(this,prev)} className={prevClasses}>上一页</Link>
                    <span>{currentPage}/{pageCount}</span>
                    <Link to={'/'+next} onClick={this.handleClick.bind(this,next)} className={nextClasses}>下一页</Link>
                </li>
            </ul>
        )
    }
}
export default Pager;