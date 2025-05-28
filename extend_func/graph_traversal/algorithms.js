import { isSearchPaused } from "./utils/pauseControl.js";

export function runBFS(grid, startCell, endCell, onFinish = () => { }) {
  const startRow = +startCell.dataset.row;
  const startCol = +startCell.dataset.col;
  const endRow = +endCell.dataset.row;
  const endCol = +endCell.dataset.col;

  const numRows = grid.length;
  const numCols = grid[0].length;

  const visited = Array.from({ length: numRows }, () => Array(numCols).fill(false));
  const prev = Array.from({ length: numRows }, () => Array(numCols).fill(null));

  const queue = [[startRow, startCol]];
  visited[startRow][startCol] = true;

  const directions = [
    [0, 1], [1, 0], [0, -1], [-1, 0]
  ];

  let isFinished = false;

  function isValid(row, col) {
    return row >= 0 && row < numRows &&
      col >= 0 && col < numCols &&
      !visited[row][col] &&
      !grid[row][col].classList.contains("wall");
  }

  function bfsStep() {

    if (isSearchPaused()) {
      setTimeout(bfsStep, 50);
      return;
    }

    if (queue.length === 0 || isFinished) {
      isFinished = true;
      onFinish(null);
      return;
    }

    const [row, col] = queue.shift();
    const cell = grid[row][col];
    cell.classList.remove("frontier");

    if (!cell.classList.contains("start") && !cell.classList.contains("end")) {
      cell.classList.add("visited");
    }

    if (row === endRow && col === endCol) {
      const length = reconstructPath(prev, grid, row, col);
      isFinished = true;
      onFinish(length);
      return;
    }

    for (const [dr, dc] of directions) {
      const newRow = row + dr;
      const newCol = col + dc;

      if (isValid(newRow, newCol)) {
        visited[newRow][newCol] = true;
        prev[newRow][newCol] = [row, col];
        queue.push([newRow, newCol]);

        const neighbor = grid[newRow][newCol];
        if (!neighbor.classList.contains("end")) {
          neighbor.classList.add("frontier");
        }
      }
    }

    setTimeout(bfsStep, 50);
  }

  bfsStep();

  return {};
}

export function runDFS(grid, startCell, endCell, onFinish = () => { }) {
  const startRow = +startCell.dataset.row;
  const startCol = +startCell.dataset.col;
  const endRow = +endCell.dataset.row;
  const endCol = +endCell.dataset.col;

  const numRows = grid.length;
  const numCols = grid[0].length;

  const visited = Array.from({ length: numRows }, () => Array(numCols).fill(false));
  const prev = Array.from({ length: numRows }, () => Array(numCols).fill(null));

  const directions = [
    [0, 1], [1, 0], [0, -1], [-1, 0]
  ];

  let isFinished = false;

  function isValid(row, col) {
    return row >= 0 && row < numRows &&
      col >= 0 && col < numCols &&
      !visited[row][col] &&
      !grid[row][col].classList.contains("wall");
  }

  function dfsStep(stack) {
    if (isSearchPaused()) {
      setTimeout(() => dfsStep(stack), 50);
      return;
    }

    if (stack.length === 0 || isFinished) {
      isFinished = true;
      onFinish(null);
      return;
    }

    const [row, col] = stack.pop();
    const cell = grid[row][col];

    if (visited[row][col]) {
      setTimeout(() => dfsStep(stack), 0);
      return;
    }

    visited[row][col] = true;

    if (!cell.classList.contains("start") && !cell.classList.contains("end")) {
      cell.classList.add("visited");
    }

    if (row === endRow && col === endCol) {
      const length = reconstructPath(prev, grid, row, col);
      isFinished = true;
      onFinish(length);
      return;
    }

    for (const [dr, dc] of directions.reverse()) {
      const newRow = row + dr;
      const newCol = col + dc;

      if (isValid(newRow, newCol)) {
        stack.push([newRow, newCol]);
        prev[newRow][newCol] = [row, col];

        const neighbor = grid[newRow][newCol];
        if (!neighbor.classList.contains("end")) {
          neighbor.classList.add("frontier");
        }
      }
    }

    setTimeout(() => dfsStep(stack), 50);
  }

  dfsStep([[startRow, startCol]]);
}

export function runDijkstra(grid, startCell, endCell, onFinish = () => { }) {
  const rows = grid.length;
  const cols = grid[0].length;

  const startRow = +startCell.dataset.row;
  const startCol = +startCell.dataset.col;
  const endRow = +endCell.dataset.row;
  const endCol = +endCell.dataset.col;

  const visited = Array.from({ length: rows }, () => Array(cols).fill(false));
  const distance = Array.from({ length: rows }, () => Array(cols).fill(Infinity));
  const prev = Array.from({ length: rows }, () => Array(cols).fill(null));

  distance[startRow][startCol] = 0;

  let queue = [{ row: startRow, col: startCol, dist: 0 }];

  const directions = [
    [0, 1], [1, 0], [0, -1], [-1, 0]
  ];

  let isFinished = false;

  function step() {
    if (isSearchPaused()) {
      setTimeout(step, 50);
      return;
    }

    if (queue.length === 0) {
      onFinish(null);
      return;
    }

    queue.sort((a, b) => a.dist - b.dist);
    const current = queue.shift();

    const { row, col } = current;

    if (visited[row][col]) {
      setTimeout(step, 0);
      return;
    }

    visited[row][col] = true;

    const cell = grid[row][col];
    if (!cell.classList.contains("start") && !cell.classList.contains("end")) {
      cell.classList.add("visited");
      cell.classList.remove("frontier");
    }

    if (row === endRow && col === endCol) {
      const length = reconstructPath2(prev, grid, endRow, endCol);
      isFinished = true;
      onFinish(length);
      return;
    }

    for (const [dr, dc] of directions) {
      const newRow = row + dr;
      const newCol = col + dc;

      if (
        newRow >= 0 && newRow < rows &&
        newCol >= 0 && newCol < cols &&
        !visited[newRow][newCol] &&
        !grid[newRow][newCol].classList.contains("wall")
      ) {
        const newDist = distance[row][col] + 1;
        if (newDist < distance[newRow][newCol]) {
          distance[newRow][newCol] = newDist;
          prev[newRow][newCol] = [row, col];
          queue.push({ row: newRow, col: newCol, dist: newDist });

          const neighbor = grid[newRow][newCol];
          if (!neighbor.classList.contains("end")) {
            neighbor.classList.add("frontier");
          }
        }
      }
    }

    setTimeout(step, 50);
  }

  step();

  return {};
}

export function runAStar(grid, startCell, endCell, onFinish = () => { }) {
  const rows = grid.length;
  const cols = grid[0].length;

  const startRow = +startCell.dataset.row;
  const startCol = +startCell.dataset.col;
  const endRow = +endCell.dataset.row;
  const endCol = +endCell.dataset.col;

  const visited = Array.from({ length: rows }, () => Array(cols).fill(false));
  const gScore = Array.from({ length: rows }, () => Array(cols).fill(Infinity));
  const fScore = Array.from({ length: rows }, () => Array(cols).fill(Infinity));
  const prev = Array.from({ length: rows }, () => Array(cols).fill(null));

  gScore[startRow][startCol] = 0;
  fScore[startRow][startCol] = heuristic(startRow, startCol, endRow, endCol);

  let openSet = [{ row: startRow, col: startCol, f: fScore[startRow][startCol] }];
  const directions = [
    [0, 1], [1, 0], [0, -1], [-1, 0]
  ];

  function step() {
    if (isSearchPaused()) {
      setTimeout(step, 50);
      return;
    }

    if (openSet.length === 0) {
      onFinish(null);
      return;
    }

    openSet.sort((a, b) => a.f - b.f);
    const current = openSet.shift();
    const { row, col } = current;

    if (visited[row][col]) {
      setTimeout(step, 0);
      return;
    }

    visited[row][col] = true;

    const cell = grid[row][col];
    if (!cell.classList.contains("start") && !cell.classList.contains("end")) {
      cell.classList.add("visited");
      cell.classList.remove("frontier");
    }

    if (row === endRow && col === endCol) {
      const length = reconstructPath2(prev, grid, endRow, endCol);
      onFinish(length);
      return;
    }

    for (const [dr, dc] of directions) {
      const newRow = row + dr;
      const newCol = col + dc;

      if (
        newRow >= 0 && newRow < rows &&
        newCol >= 0 && newCol < cols &&
        !visited[newRow][newCol] &&
        !grid[newRow][newCol].classList.contains("wall")
      ) {
        const tentativeG = gScore[row][col] + 1;

        if (tentativeG < gScore[newRow][newCol]) {
          gScore[newRow][newCol] = tentativeG;
          const h = heuristic(newRow, newCol, endRow, endCol);
          fScore[newRow][newCol] = tentativeG + h;
          prev[newRow][newCol] = [row, col];
          openSet.push({ row: newRow, col: newCol, f: fScore[newRow][newCol] });

          const neighbor = grid[newRow][newCol];
          if (!neighbor.classList.contains("end")) {
            neighbor.classList.add("frontier");
          }
        }
      }
    }

    setTimeout(step, 50);
  }

  step();
}

function heuristic(x1, y1, x2, y2) {
  return Math.abs(x1 - x2) + Math.abs(y1 - y2);
}

function reconstructPath(prev, grid, row, col) {
  let cur = [row, col];
  let length = 0;

  while (cur) {
    const [r, c] = cur;
    const cell = grid[r][c];

    if (!cell.classList.contains("start") && !cell.classList.contains("end")) {
      cell.classList.add("path")
      length++;
    }
    cur = prev[r][c];
  }

  return length;
}

function reconstructPath2(prev, grid, endRow, endCol) {
  let pathLength = 0;
  let row = endRow;
  let col = endCol;

  while (prev[row][col] !== null) {
    const cell = grid[row][col];
    if (!cell.classList.contains("start") && !cell.classList.contains("end")) {
      cell.classList.remove("visited", "frontier");
      cell.classList.add("path");
    }
    [row, col] = prev[row][col];
    pathLength++;
  }

  return pathLength - 1;
}