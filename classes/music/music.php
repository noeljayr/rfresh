<?php

class Music extends Dbh
{
    protected function createMusic($musicData)
    {
        $musicData['status'] = 'Active';
        $sql = 'INSERT INTO `Music` (`Title`, `Artist`, `Album`, `Genre`, `ReleaseDate`, `Duration`, `FilePath`, `status`) VALUES (:Title, :Artist, :Album, :Genre, :ReleaseDate, :Duration, :FilePath, :status)';

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute($musicData);
            return 'done';
        } catch (PDOException $e) {
            error_log('Error creating music: ' . $e->getMessage());
            return 'query failed';
        }
    }

    protected function updateMusic($musicData)
    {
        $sql = 'UPDATE `Music` SET `Title` = :Title, `Artist` = :Artist, `Album` = :Album, `Genre` = :Genre, `ReleaseDate` = :ReleaseDate, `Duration` = :Duration, `FilePath` = :FilePath WHERE `MusicID` = :MusicID';

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute($musicData);
            return 'done';
        } catch (PDOException $e) {
            error_log('Error updating music: ' . $e->getMessage());
            return 'query failed ' . $e->getMessage();
        }
    }

    protected function getMusicById($musicId)
    {
        $sql = 'SELECT * FROM `Music` WHERE `MusicID` = :MusicID';
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['MusicID' => $musicId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching music by ID: ' . $e->getMessage());
            return null;
        }
    }

    protected function getMusicByTitle($musicTitle)
    {
        $sql = 'SELECT * FROM `Music` WHERE `Title` = :Title';
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['Title' => $musicTitle]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching music by title: ' . $e->getMessage());
            return null;
        }
    }

    // protected function getMusics()
    // {
    //     $sql = 'SELECT * FROM `Music`';
    //     try {
    //         $stmt = $this->connect()->prepare($sql);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         error_log('Error fetching musics: ' . $e->getMessage());
    //         return null;
    //     }
    // }
    // Inside the Music class

protected function getMusics($searchParams = [])
{
    // Build the SQL query based on search parameters
    $sql = 'SELECT * FROM `Music` WHERE 1 ';

    // Add conditions for each search parameter
    if (!empty($searchParams['title'])) {
        $sql .= 'AND `Title` LIKE :title ';
    }

    if (!empty($searchParams['artist'])) {
        $sql .= 'AND `Artist` LIKE :artist ';
    }

    if (!empty($searchParams['album'])) {
        $sql .= 'AND `Album` LIKE :album ';
    }


    try {
        $stmt = $this->connect()->prepare($sql);

        // Bind values for each search parameter
        if (!empty($searchParams['title'])) {
            $stmt->bindValue(':title', '%' . $searchParams['title'] . '%', PDO::PARAM_STR);
        }

        if (!empty($searchParams['artist'])) {
            $stmt->bindValue(':artist', '%' . $searchParams['artist'] . '%', PDO::PARAM_STR);
        }

        if (!empty($searchParams['album'])) {
            $stmt->bindValue(':album', '%' . $searchParams['album'] . '%', PDO::PARAM_STR);
        }

        // Bind more values for other fields as needed...

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error fetching musics: ' . $e->getMessage());
        return null;
    }
}

public function searchMusic($query)
{
    // Split the query into individual search terms
    $searchTerms = explode(' ', $query);

    // Build an array of search parameters
    $searchParams = [];
    foreach ($searchTerms as $term) {
        $searchParams['title'] = $term;
        $searchParams['artist'] = $term;
        $searchParams['album'] = $term;
        // Add more fields for other search criteria...
    }

    // Call the getMusics method with the search parameters
    return $this->getMusics($searchParams);
}


    protected function deactivateMusic($musicId)
    {
        $sql = 'UPDATE `Music` SET `status` = :status WHERE `MusicID` = :MusicID';

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['status' => 'Inactive', 'MusicID' => $musicId]);
            return 'done';
        } catch (PDOException $e) {
            error_log('Error deactivating music: ' . $e->getMessage());
            return 'query failed';
        }
    }

    function __destruct()
    {
        $this->close_connection();
    }
}

?>
