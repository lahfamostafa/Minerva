<?php

class work
{
    private ?int $id;
    private string $title;
    private string $description;
    private string $filePath;
    private int $classId;
    private int $teacherId;
    private string $deadline;

    public function __construct(?int $id, string  $title, string $description, string $filePath, int $classId, int $teacherId, string $deadline)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->filePath = $filePath;
        $this->classId = $classId;
        $this->teacherId = $teacherId;
        $this->deadline = $deadline;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getFilePath(): string
    {
        return $this->filePath;
    }
    public function getClassId(): int
    {
        return $this->classId;
    }
    public function getTeacherId(): int
    {
        return $this->teacherId;
    }
    public function getDeadline(): string
    {
        return $this->deadline;
    }
}
