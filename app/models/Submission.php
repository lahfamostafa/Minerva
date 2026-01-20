<?php

    class Submission{
    private ?int $id;
    private int $studentId;
    private int $workId;
    private string $filePath;
    private string $submittedAt;

    public function __construct(?int $id, int $studentId, int $workId, string $filePath, string $submittedAt)
    {
        $this->id = $id;
        $this->studentId = $studentId;
        $this->workId = $workId;
        $this->filePath = $filePath;
        $this->submittedAt = $submittedAt;  

    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getStudentId(): int
    {
        return $this->studentId;
    }
    public function getWorkId(): int
    {
        return $this->workId;
    }
    public function getFilePath(): string
    {
        return $this->filePath;
    }
    public function getSubmittedAt(): string
    {
        return $this->submittedAt;
    }
    }



?>