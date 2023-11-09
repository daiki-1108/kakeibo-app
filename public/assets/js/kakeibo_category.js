import React, { Component } from 'react';

class KakeiboTable extends Component {
    render() {
        return (
            <table className="top_detail">
                <tr>
                    <th className="category">カテゴリ</th>
                    <th className="total">合計額</th>
                </tr>
                {/* ループしてテーブルの行を生成 */}
                {this.props.posts.map(post => (
                    <tr key={post.category_id}>
                        <td>
                            <a href={`/kb/kakeibo/detail/${post.category_id}`}>{this.props.category_name[post.category_id]}</a>
                        </td>
                        <td>
                            {this.props.category_totals[post.category_id]}円
                        </td>
                    </tr>
                ))}
            </table>
        );
    }
}

export default KakeiboTable;
