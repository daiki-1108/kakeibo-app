import React from 'react';

const root = ReactDOM.render(
  <CategoryTotals categoryTotals={categoryTotalsData} />,
  document.getElementById('category-totals-container')
  );

var roop_categorytotals = () => {
  const items = [];
  for (let i = 0; i < categoryTotals.length; i++) {
    items.push(<li>{ categoryTotals[i] }</li>)
  }
  return <ul>{ items }</ul>;
};

var roop_categoryname = () => {
  const names = [];
  for (let i = 0; i < category_name.length; i++){
    names.push(<li>{categoryName[i]}</li>)
  }
  return <ui>{names}</ui>;
}

const CategoryTotals = () => {
  return (
    <table>
      <thead className="top_detail">
        <tr>
          <th className="category">カテゴリ</th>
          <th className="total">合計額</th>
        </tr>
      </thead>
      <tbody>
            <td><a href={`/kb/kakeibo/detail/${categoryId}`}>{roop_categoryname()}</a></td>
            <td>{roop_categorytotals()}円</td>
      </tbody>
    </table>
  );
};
  

  root.render(CategoryTotals);



