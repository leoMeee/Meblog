import React from 'react';
import {Link} from 'react-router';
import classNames from  'classnames';

class Pager extends React.Component {

    render() {
        let {pageCount, currentPage} = this.props;
        let prev = currentPage - 1 < 1 ? '' : currentPage - 1;
        let next = currentPage + 1 > pageCount ? currentPage : currentPage + 1;

        let prevClasses = classNames('p',{
            disabled: currentPage <= 1
        });
        let nextClasses = classNames('p',{
            disabled: currentPage >= pageCount
        });

        return (
            <ul className="pager">
                <li >
                    <Link to={'/'+prev} className={prevClasses}>上一页</Link>
                    <span>{currentPage}/{pageCount}</span>
                    <Link to={'/'+next} className={nextClasses}>下一页</Link>
                </li>
            </ul>
        )
    }
}
export default Pager;