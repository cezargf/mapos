<?php

use PHPUnit\Framework\TestCase;

class ClientesModelTest extends TestCase
{
    private $model;
    private $dbMock;

    protected function setUp(): void
    {
        $this->model = new Clientes_model();

        $this->dbMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['insert', 'affected_rows', 'insert_id', 'error'])
            ->getMock();

        $this->model->db = $this->dbMock;
    }

    public function testAddSuccess()
    {
        $table = 'clientes';
        $data = ['nome' => 'Test User'];
        $expectedInsertId = 123;

        $this->dbMock->expects($this->once())
            ->method('insert')
            ->with($table, $data);

        $this->dbMock->expects($this->once())
            ->method('affected_rows')
            ->willReturn(1);

        $this->dbMock->expects($this->once())
            ->method('insert_id')
            ->willReturn($expectedInsertId);

        $result = $this->model->add($table, $data);

        $this->assertEquals($expectedInsertId, $result);
    }

    public function testAddFailsDueToNoAffectedRows()
    {
        $table = 'clientes';
        $data = ['nome' => 'Test User'];

        $this->dbMock->expects($this->once())
            ->method('insert')
            ->with($table, $data);

        $this->dbMock->expects($this->once())
            ->method('affected_rows')
            ->willReturn(0);

        $this->dbMock->expects($this->never())
            ->method('insert_id');

        $result = $this->model->add($table, $data);

        $this->assertFalse($result);
    }

    public function testAddFailsDueToDatabaseError()
    {
        $table = 'clientes';
        $data = ['nome' => 'Test User'];

        // Simulate an insert that fails (returns false or similar depending on DB layer,
        // but typically in CodeIgniter insert() might return false on error
        // though here we test the explicit DB error behavior)
        $this->dbMock->expects($this->once())
            ->method('insert')
            ->with($table, $data)
            ->willReturn(false);

        $this->dbMock->expects($this->once())
            ->method('affected_rows')
            ->willReturn(-1); // Some DB adapters return -1 on error

        // If insert failed, no insert_id should be checked
        $this->dbMock->expects($this->never())
            ->method('insert_id');

        $result = $this->model->add($table, $data);

        $this->assertFalse($result);
    }
}
