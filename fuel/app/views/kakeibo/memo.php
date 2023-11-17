メモ
<?php foreach ($posts as $post): ?>
    <td><?php  echo $post->amount; ?></td>
    <?php endforeach; ?>
<table class="top_detail">
        <tr>
          <th class="category">カテゴリ</th>
          <th class="total">合計額</th>
        </tr> 
            <?php $pre_id = 0 ?>
            <?php foreach ($posts as $post): ?>
              <?php if($post->category_id != $pre_id): ?>
                  <tr> 
                    <td><a href="/kb/kakeibo/detail/<?php echo $post->category_id; ?>"><?php echo $post->category_name->name; ?></a></td>
                      <?php for($i = 0; $i < $Max_kinds; $i++): ?>
                        <?php if($post->category_id == $i): ?>
                          <td><?php  echo $category_totals[$i]; ?>円</td>
                        <?php endif; ?>
                       <?php endfor; ?>
                  </tr>
                <?php $pre_id = $post->category_id ?> 
              <?php endif; ?>
            <?php endforeach; ?>
        </table>



        <div id="category-totals-container"></div>
        {Object.keys(categoryTotals).map(categoryId=> (    //mapメソッドでループ
          <tr key={categoryId}>
            <td><a href={`/kb/kakeibo/detail/${categoryId}`}>{category_name[categoryId]}</a></td>
            <td>{categoryTotals[categoryId].total}円</td>
          </tr>
        ))}
        <script>
       let category_name = JSON.parse(<?php echo json_encode($posts); ?>);
       let category_name = JSON.parse(<?php echo json_encode($category_name); ?>);
       let categoryTotals = JSON.parse(<?php echo json_encode($category_totals); ?>);
   </script>
   
const root = ReactDOM.render(
  <CategoryTotals categoryTotals={categoryTotalsData} />,
  document.getElementById('category-totals-container')
  );
  root.render(CategoryTotals);
  import React from 'react';

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


<option value="0">選択してください</option>
                <option value="1">食費</option>
                <option value="2">交通費</option>
                <option value="3">趣味</option>
                <option value="4">日用品</option>
                <option value="5">交際費</option>
                <option value="6">衣服・美容</option>
                <option value="7">その他</option>
     

                <table class="detail">
            <tr>
                <td>日付</td>
                <td>金額</td>
                <td>編集</td>
                <td>削除</td>
            </tr>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo date('Y/m/d', strtotime($post->date)); ?>   </td>
                <td><?php echo $post->amount; ?>円   </td>
                <td><a href="/kb/kakeibo/editForm/<?php echo $post->id ?>">編集  </a></td>
                <td><a href="/kb/kakeibo/delete/<?php echo $post->id ?>">削除  </a></td>
            </tr>
            <?php endforeach; ?>
        </table>