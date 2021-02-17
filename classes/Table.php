<?php

require_once './db.php';

/**
 * Permet de créer des tableaux à partir de la base de données.
 */
class Table
{

    public $header;
    public $dbTable;
    public $dbColumn;
    public $db = null;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param str L'en-tête du tableau.
     * @param str La table de la base de données.
     * @param str La colonne de la table en question.
     */
    public function createTable($header, $dbTable, $dbColumn)
    {
        $queries = $this->db->query('SELECT * FROM ' . $dbTable);
        $x = array();
        while ($query = $queries->fetch()) {
            $x[] = '<tr><td>' . $query[$dbColumn] . '</td></tr>';
        }
        return
            '<table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>' . $header . '</th>
                </tr>
            </thead>
            <tbody>' .
            implode('', $x)
            . '</tbody>
        </table>';
    }
}
