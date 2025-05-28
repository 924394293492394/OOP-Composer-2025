<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../styles/unigraph.css">
    <script type="text/javascript" src="https://unpkg.com/vis-network@9.0.0/dist/vis-network.min.js"></script>
    <script src="../toggleView.js"></script>
</head>

<body>
    <div class="container" id="graph-form">
        <h1>Поиск в ширину (BFS)</h1>
        <form method="post">
            <label for="edges">Введите рёбра графа:</label>
            <input type="text" id="edges" name="edges" required placeholder="Пример: 1-2, 2-3">

            <label for="start">Начальная вершина:</label>
            <input type="text" id="start" name="start" required placeholder="Пример: 2">

            <label for="end">Конечная вершина:</label>
            <input type="text" id="end" name="end" required placeholder="Пример: 14">

            <label for="directed">Ориентированный граф: <input type="checkbox" id="directed" name="directed"></label>

            <button type="submit">Поиск пути</button>
        </form>
    </div>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <script>
            toggleView(false);
        </script>
        <?php
        /**
         * fix error Expected type 'null|array'. Found 'int' для $bestPath на 128 
         * @return array [path, minCost]
         */
        function bfs($graph, $start, $end)
        {
            $visited = [];
            $prev = [];
            $queue = new SplQueue();

            $visited[$start] = true;
            $queue->enqueue($start);
            $prev[$start] = null;

            while (!$queue->isEmpty()) {
                $current = $queue->dequeue();

                if (!isset($graph[$current])) continue;

                foreach ($graph[$current] as $neighbor => $_) {
                    if (!isset($visited[$neighbor])) {
                        $visited[$neighbor] = true;
                        $prev[$neighbor] = $current;
                        $queue->enqueue($neighbor);

                        if ($neighbor == $end) break 2;
                    }
                }
            }

            $path = [];
            for ($v = $end; $v !== null; $v = $prev[$v]) {
                array_unshift($path, $v);
            }

            if (empty($path) || $path[0] !== $start) {
                return [[], -1];
            }

            return [$path, count($path) - 1];
        }

        $edges = explode(", ", $_POST['edges']);
        $start = (int)$_POST['start'];
        $end = (int)$_POST['end'];
        $directed = isset($_POST['directed']);

        $graph = [];
        $vertices = [];
        $errorMessage = '';

        if ($start < 1 || $end < 1) {
            $errorMessage = "Ошибка: Вершины должны быть положительными.";
        } else {
            foreach ($edges as $edge) {
                list($pair) = explode(":", $edge);
                list($u, $v) = explode("-", $pair);
                $u = (int)$u;
                $v = (int)$v;

                if ($u < 1 || $v < 1) {
                    $errorMessage = "Ошибка: Вершины не могут быть отрицательными.";
                }

                $graph[$u][$v] = 1;
                $vertices[$u] = $vertices[$v] = true;
                if (!$directed) $graph[$v][$u] = 1;
            }

            if (!isset($vertices[$start]) || !isset($vertices[$end])) {
                $errorMessage = "Ошибка: Одна из вершин не существует.";
            }
        }

        if ($errorMessage): ?>
            <div class="main-container">
                <div class="error-card">
                    <h3 class="error-message"><?= $errorMessage ?></h3>
                    <div class="repeat-link">
                        <a href="bfs.php" class="button">Повторный ввод</a>
                    </div>
                </div>
            </div>
        <?php else:
            $minCost = PHP_INT_MAX;

            list($bestPath, $minCost) = bfs($graph, $start, $end);
        ?>
            <div class="main-container">
                <div class="result-section" id="result-container">
                    <h2 class="result-title center">Результат поиска</h2>
                    <h2 class="path-title no-margin">Кратчайший путь от <?= $start ?> до <?= $end ?>:</h2>
                    <p class="shortest-path">
                        <?= !empty($bestPath) ? implode(" -> ", $bestPath) . " (Длина пути: $minCost)" : "Путь не найден." ?>
                    </p>

                    <h2 class="path-title no-margin">Визуализация графа</h2>
                    <div id="mynetwork" class="network-container"></div>
                    <script type="text/javascript">
                        var nodes = new vis.DataSet([<?php foreach (array_keys($vertices) as $node): ?> {
                                    id: <?= $node ?>,
                                    label: '<?= $node ?>',
                                    font: {
                                        color: 'black',
                                        size: 24,
                                        bold: true
                                    }
                                },
                            <?php endforeach; ?>
                        ]);

                        var edgesArray = [];
                        <?php foreach ($graph as $u => $adj): foreach ($adj as $v => $weight): ?>
                                edgesArray.push({
                                    from: <?= $u ?>,
                                    to: <?= $v ?>,
                                    label: '<?= $weight ?>',
                                    width: 2
                                });
                        <?php endforeach;
                        endforeach; ?>

                        var bfsPath = <?= json_encode($bestPath) ?>;

                        for (var i = 0; i < bfsPath.length - 1; i++) {
                            for (var j = 0; j < edgesArray.length; j++) {
                                if (edgesArray[j].from === bfsPath[i] && edgesArray[j].to === bfsPath[i + 1]) {
                                    edgesArray[j].color = 'red';
                                    edgesArray[j].width = 4;
                                    break;
                                }
                            }
                        }

                        var edges = new vis.DataSet(edgesArray);
                        var container = document.getElementById('mynetwork');
                        var data = {
                            nodes: nodes,
                            edges: edges
                        };
                        var options = {
                            nodes: {
                                shape: 'dot',
                                size: 12
                            },
                            edges: {
                                width: 2
                            }
                        };

                        new vis.Network(container, data, options);
                    </script>

                    <div class="button-container">
                        <a href="bfs.php" class="button">Повторный ввод</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>